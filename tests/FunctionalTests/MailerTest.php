<?php

namespace VisualCraft\EmailTypesBundle\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;
use VisualCraft\EmailTypesBundle\Mailer;
use VisualCraft\EmailTypesBundle\Tests\TestApplication\EmailType\MessageEmailType;

class MailerTest extends KernelTestCase
{
    use MailerAssertionsTrait;

    public function testSend(): void
    {
        /** @var Mailer $mailer */
        $mailer = $this->getContainer()->get(Mailer::class);

        $mailer->send(MessageEmailType::class, []);

        $this->assertEmailCount(1);

        $email = $this->getMailerMessage();

        $this->assertEmailHtmlBodyContains($email, '<p>test html</p>');
        $this->assertEmailTextBodyContains($email, 'test text');
    }
}