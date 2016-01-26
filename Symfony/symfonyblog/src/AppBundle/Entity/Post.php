<?php

// src/AppBundle/Entity/Post.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */
class Post {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="text")
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $body;

    /**
     * @ORM\Column(type="text")
     */
    protected $url;

    function __construct($id, $created_at, $title, $body, $url) {
        $this->id = $id;
        $this->created_at = $created_at;
        $this->title = $title;
        $this->body = $body;
        $this->url = $url;
    }

    function getId() {
        return $this->id;
    }

    function getCreated_at() {
        return $this->created_at;
    }

    function getTitle() {
        return $this->title;
    }

    function getBody() {
        return $this->body;
    }

    function getUrl() {
        return $this->url;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setBody($body) {
        $this->body = $body;
    }

    function setUrl($url) {
        $this->url = $url;
    }

}
