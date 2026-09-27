<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EspeceRepository;
use App\Model\OpieApi;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'sync:photos',
    description: 'Synchronise les photos depuis iNaturalist',
)]
class SyncPhotosCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private EspeceRepository $especeRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $especes = $this->especeRepository->findAll();

        foreach ($especes as $espece) {
            $detail = OpieApi::detail($espece->getEspece());
            
            if (!empty($detail) && isset($detail['default_photo']['medium_url'])) {
                $espece->setPhoto($detail['default_photo']['medium_url']);
                $io->text('✓ ' . $espece->getEspece());
            } else {
                $io->text('✗ ' . $espece->getEspece() . ' (pas de photo)');
            }
        }

        $this->entityManager->flush();
        $io->success('Photos synchronisées !');

        return Command::SUCCESS;
    }
}
