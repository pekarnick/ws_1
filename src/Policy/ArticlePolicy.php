<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Article;
use Authorization\IdentityInterface;

class ArticlePolicy {

    public function canAdd(IdentityInterface $user, Article $article) {
        // All logged in users can create articles.
//        echo $article->user_id."<br>";
//        echo $user->getIdentifier()."<br>";
////        echo $user->getService()."<br>";
//        pr($user);
//        exit;
        return true;
    }

    public function canEdit(IdentityInterface $user, Article $article) {
        // logged in users can edit their own articles.
//         echo $article->user_id."<br>";
//        echo $user->getIdentifier()."<br>";
////        echo $user->getService()."<br>";
//        pr($user);
//        exit;
        return $this->isAuthor($user, $article);
    }

    public function canDelete(IdentityInterface $user, Article $article) {
        // logged in users can delete their own articles.
        return $this->isAuthor($user, $article);
    }

    protected function isAuthor(IdentityInterface $user, Article $article) {
        return $article->user_id === $user->getIdentifier();
    }

}
