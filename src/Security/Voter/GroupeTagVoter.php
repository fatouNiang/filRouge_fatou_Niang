<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class GroupeTagVoter extends Voter
{
    protected function supports($attribute, $subject)
    {

        return in_array($attribute, ['POST','EDIT', 'DELETE', 'VIEW', 'VIEW_ALL']);
            //&& $subject instanceof \App\Entity\GroupeTag;
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
            case 'VIEW':
                return $user->getRoles()[0]=="ROLE_ADMIN"
                || $user->getRoles()[0]=="ROLE_Formateur";
                break;

            case 'VIEW_ALL':
                return $user->getRoles()[0]=="ROLE_ADMIN" 
                || $user->getRoles()[0]=="ROLE_Formateur";
                break;

            case 'POST':
                return $user->getRoles()[0]=="ROLE_ADMIN" || $user->getRoles()[0]=="ROLE_Formateur";

                break;
            case 'EDIT':
                return $user->getRoles()[0]=="ROLE_ADMIN" || $user->getRoles()[0]=="ROLE_Formateur";

                break;
            case 'DELETE':
                return $user->getRoles()[0]=="ROLE_ADMIN" || $user->getRoles()[0]=="ROLE_Formateur";

                break;
                default;
        }

        return false;
    }
}
