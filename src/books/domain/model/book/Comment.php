<?php

namespace books\domain\model\book;

use books\domain\model\reader\ReaderId;
use books\validators\Assert;

final class Comment {

    /**
     * @var CommentId
     */
    private $commentId;

    /**
     * @var ReaderId
     */
    private $readerId;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @param CommentId $commentId
     * @param ReaderId  $readerId
     * @param string    $comment
     */
    public function __construct(CommentId $commentId, ReaderId $readerId, string $comment) {
        $this->commentId = $commentId;
        $this->readerId = $readerId;
        $this->setComment($comment);
        $this->createdAt = new \DateTime();
    }

    /**
     * @param string $comment
     */
    private function setComment(string $comment) {
        Assert::notEmpty($comment, "Book comment can't be empty");
        $this->comment = $comment;
    }

    /**
     * @return CommentId
     */
    public function id(): CommentId { return $this->commentId; }

    /**
     * @return string
     */
    public function comment(): string { return $this->comment; }

    /**
     * @return ReaderId
     */
    public function reader(): ReaderId { return $this->readerId; }

    /**
     * @return \DateTime
     */
    public function createdAt(): \DateTime { return $this->createdAt; }
}
