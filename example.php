<?php

namespace Notifications;

use Notifications\Entity\User;
use Notifications\Event\NewArticleEvent;
use Notifications\Event\NewCommentEvent;
use Notifications\NotificationStrategy\EmailNotificationStrategy;
use Notifications\NotificationStrategy\SmsNotificationStrategy;
use Notifications\Entity\Template\MailTemplate;
use Notifications\Entity\Template\SmsTemplate;

/**
 * This file demonstrates how to use the Notifications system.
 * It creates 3 CMS users with different roles and different subscription settings (some are subscribed
 * to emails, others to SMS messages). It then creates 3 different templates of different types (SMS / Email)
 * and associates them with different event types (New comment / New article).
 * Finally it demonstrates how the system would be hooked into an existing CMS. A listener instance is created
 * and two different Events are fired (one from a article creation controller, another from comment creation controller).
 * Feel free to add / edit users and templates and examine the results by running:
 * php example.php
 * Have fun!
 */

// simple autoloader that converts namespace to directory path in order to locate class files
spl_autoload_register(function($class) {
    $dirStructure = explode('\\', $class);
    array_shift($dirStructure);//first element is "Notifications", which is the root namespace of the project
    require_once(__DIR__ . '/' . join('/', $dirStructure) . '.php');
});

/**
 * In a real-world system, the following entities would be created in CMS by an admin using CRUD
 */
$user1 = new User();
$user1->setName('Pavle Predic');
$user1->setEmail('pavle.predic@example.com');
$user1->setRole(User::ROLE_MODERATOR);
$user1->setNotificationStrategy(new EmailNotificationStrategy());
$user1->subscribeToEvent(new NewCommentEvent());

$user2 = new User();
$user2->setName('Enzo Molinari');
$user2->setPhone('+3811132956');
$user2->setRole(User::ROLE_MODERATOR);
$user2->setNotificationStrategy(new SmsNotificationStrategy());
$user2->subscribeToEvent(new NewCommentEvent());

$user3 = new User();
$user3->setName('Administrator');
$user3->setEmail('administrator@example.com');
$user3->setRole(User::ROLE_ADMIN);
$user3->setNotificationStrategy(new EmailNotificationStrategy());
$user3->subscribeToEvent(new NewArticleEvent());

$newCommentMailTemplate = new MailTemplate();
$newCommentMailTemplate->setSubject('New comment has been posted');
$newCommentMailTemplate->setText('Dear %user%, new comment has been posted on your site on page "%page%". Go to comments panel and moderate it.');
$newCommentMailTemplate->setEvent(new NewCommentEvent());

$newCommentSmsTemplate = new SmsTemplate();
$newCommentSmsTemplate->setText('New comment has been posted on page "%page%".');
$newCommentSmsTemplate->setEvent(new NewCommentEvent());

$newArticleMailTemplate = new MailTemplate();
$newArticleMailTemplate->setSubject('New post has been created');
$newArticleMailTemplate->setText('Dear %user%, new article has been created on your site in category "%category%". Go to articles panel and moderate it.');
$newArticleMailTemplate->setEvent(new NewArticleEvent());

/**
 * The following code is triggered somewhere from the CMS
 * For the example of a new comment, we would add the following to the CRUD controller that creates the comment
 */
$listener = new Listener(); //this will likely be a global service

$page = 'My blog post'; //let's assume we got this from the CRUD controller
$event = new NewCommentEvent();
$event->setPage($page);
$listener->handleEvent($event);

/**
 * And the following might be triggered from the article creation CRUD controller
 */
$cat = 'You won\'t believe what happened next!'; //let's assume we got this from the CRUD controller
$event = new NewArticleEvent();
$event->setCategory($cat);
$listener->handleEvent($event);
