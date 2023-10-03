<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostNotifi extends Notification
{
    use Queueable;
    private $newPost;
    private $roleCurrentPost;
    /**
     * Create a new notification instance.
     */
    public function __construct($post, $role)
    {
        $this->newPost = $post;
        $this->roleCurrentPost = $role;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $post = $this->newPost;
        $role = $this->roleCurrentPost;
        $arSummary = [];
        $arSummary['role_slug'] = $role->slug;
        $arSummary['project']['id'] = $post->project->id;
        $arSummary['project']['url'] = $post->project->url;
        $arSummary['project']['title'] = $post->project->title;
//        $arSummary['user'] = $notifiable->toArray();
        $arSummary['post']['priority'] = $post->priority;
        $arSummary['post']['title'] = $post->title;
        $arSummary['post']['id'] = $post->id;
        return $arSummary;
    }
}
