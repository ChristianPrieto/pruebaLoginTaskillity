<?php

namespace App\DataFixtures;

use App\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UsuarioFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(PasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // Usuario normal
        $usuario = new Usuario();
        $usuario->setNombre("Laura");
        $usuario->setApellidos("Martín");
        $usuario->setEmail("laury28@gmail.com");
        $usuario->setPassword($this->passwordHasher->hashPassword(
            $usuario,
            'servilleta' // La contraseña
        ));
        $manager->persist($usuario);

        // Usuario administrador
        $usuario = new Usuario();
        $usuario->setNombre("Manuel");
        $usuario->setApellidos("Martín");
        $usuario->setEmail("manolo30@gmail.com");
        $usuario->setPassword($this->passwordHasher->hashPassword(
            $usuario,
            'Sevilla12'
        ));
        // Le damos el rol de administrador (ROLE_ADMIN).
        $usuario->setRoles(array("ROLE_ADMIN"));
        $manager->persist($usuario);

        $manager->flush();
    }
}
