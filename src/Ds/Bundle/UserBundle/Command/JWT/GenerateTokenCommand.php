<?php

namespace Ds\Bundle\UserBundle\Command\JWT;

use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ds\Bundle\UserBundle\Security\User\User;
use Ramsey\Uuid\Uuid;
use Exception;

/**
 * Class CreateUserCommand
 */
class GenerateTokenCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('ds:user:jwt:generate-token')
            ->setDescription('Generate a JWT user token.')
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
            ->addArgument('role', InputArgument::REQUIRED, 'The role of the user.')
            ->addArgument('uuid', InputArgument::OPTIONAL, 'The uuid of the user.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Generating a JWT user token...');
        $output->writeln('');

        $username = $input->getArgument('username');
        $role = $input->getArgument('role');

        if ($input->getArgument('uuid')) {
            $uuid = $input->getArgument('uuid');
        } else {
            $uuid = Uuid::uuid4()->toString();
        }

        $user = new User($username, [ $role ], $uuid);
        $jwtManager = $this->getContainer()->get('ds_user.service.jwt_manager');
        $token = $jwtManager->create($user);

        $output->writeln($token);
        $output->writeln('');

        if (!$input->getArgument('uuid')) {
            $output->writeln($uuid);
            $output->writeln('');
        }
    }
}
