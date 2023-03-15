<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Especes;
use App\Repository\EspecesRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'import:data',
    description: 'Add a short description for your command',
)]
class ImportDataCommand extends Command
{

    const PATTERN_MATCH_PARENTHESIS = '/[a-zA-Z ]+\(.*\)/';
    const PATTERN_REPLACE_PARENTHESIS = '/([a-zA-Z ]+)\(.*\)/';
    const PATTERN_MATCH_DASH = '/[a-zA-Z ]+-.*/';
    const PATTERN_REPLACE_DASH = '/([a-zA-Z ]+)-.*/';

    public $entityManager;
    public $especeRepository;

    public function __construct(EntityManagerInterface $entityManager,EspecesRepository $especeRepository)
    {
        $this->especeRepository= $especeRepository;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $fileFolder = __DIR__ . '/../../public/'; 

        $file= "liste.xlsx";
        $spreadsheet = IOFactory::load($fileFolder.$file);
        $row = $spreadsheet->getActiveSheet()->removeRow(1);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); 
        
        foreach($sheetData as $data){
            if (preg_match(self::PATTERN_MATCH_PARENTHESIS, $data["A"])) {
                $data["A"] = trim(preg_replace(self::PATTERN_REPLACE_PARENTHESIS, '${1}', $data["A"]));
            } else if (preg_match(self::PATTERN_MATCH_DASH, $data["A"])) {
                $data["A"] = trim(preg_replace(self::PATTERN_REPLACE_DASH, '${1}', $data["A"]));
            } else {
                $explode = explode(' ', $data["A"]);
                if (count($explode) > 2 && count($explode) % 2 === 0) {
                    $data["A"] = "";
                    for ($i = 0; $i < count($explode) / 2; $i++) {
                        $data["A"] .= ' ' . $explode[$i];
                    }
                }
            }

            $dataUpdate[] = [
                "A" => trim(str_replace(['<i>', '</i>'], '', $data["A"])),
                "B" => $data["B"]
            ];
        }

        if(!$dataUpdate){
            $this->insertDataBase($dataUpdate); 
        }
            
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }

    function insertDataBase(array $data)
    {
        foreach($data as $d){
            $espece = new Especes();
            $espece->setEspece($d["A"]);
            $espece->setGenre($d["B"]);
            $this->entityManager->persist($espece);
            $this->entityManager->flush();
        }
    }
}
