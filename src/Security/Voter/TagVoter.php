<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Security;


class TagVoter extends Voter
{

    

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['GET', 'POST','DELETE', 'PUT']);
           // && $subject instanceof \App\Entity\Tag;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'GET':
                return $user->getRoles()[0]==="ROLE_ADMIN" || $user->getRoles()[0]==="ROLE_Formateur" ;

                ////return $ProfilSortie->getUser()->getId()== $user->getId();
                //if ( $this->security->isGranted(Role::ROLE_ADMIN) ) { return true; }
                break;
            case 'POST':
            return $user->getRoles()[0]==="ROLE_ADMIN" || $user->getRoles()[0]==="ROLE_Formateur" ;
                break;
            case 'DELETE':
               return $user->getRoles()[0]==="ROLE_ADMIN";    
                break;
            case 'PUT':
            return $user->getRoles()[0]==="ROLE_ADMIN"|| $user->getRoles()[0]==="ROLE_Formateur";
                
                break;
           default;
        }

        return false;
    }
}
