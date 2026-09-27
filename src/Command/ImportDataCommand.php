<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Espece;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'import:data',
    description: 'Importe les espèces depuis le fichier liste.xlsx',
)]
class ImportDataCommand extends Command
{
    const PATTERN_MATCH_PARENTHESIS = '/[a-zA-Z ]+\(.*\)/';
    const PATTERN_REPLACE_PARENTHESIS = '/([a-zA-Z ]+)\(.*\)/';
    const PATTERN_MATCH_DASH = '/[a-zA-Z ]+-.*/';
    const PATTERN_REPLACE_DASH = '/([a-zA-Z ]+)-.*/';

    public $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $fileFolder = __DIR__ . '/../../data/';
        $file = "liste.xlsx";
        $spreadsheet = IOFactory::load($fileFolder . $file);
        $spreadsheet->getActiveSheet()->removeRow(1);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        foreach ($sheetData as $data) {
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
                "B" => $data["B"],
                "C" => $data["C"] ?? null
            ];
        }

        if (!empty($dataUpdate)) {
            $this->insertDataBase($dataUpdate);
        }

        $io->success('Import terminé avec succès !');

        return Command::SUCCESS;
    }

    function insertDataBase(array $data)
    {
        foreach ($data as $d) {
            $espece = new Espece();
            $espece->setEspece($d["A"]);
            $espece->setGenre($d["B"]);
            $espece->setHabitat($d["C"] ?? null);
            $this->entityManager->persist($espece);
        }
        $this->entityManager->flush();
    }
}