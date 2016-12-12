<?php

namespace books\infrastructure\domain\model\book;

use books\domain\model\book\Comment;
use books\domain\model\book\CommentId;
use books\domain\model\book\CommentRepository;
use books\domain\model\book\InvalidCommentException;

class MemoryCommentRepository implements CommentRepository {
    /**
     * @var array
     */
    private $map;

    public function __construct() {
        $this->map = [];
    }

    /**
     * @param CommentId $commentId
     *
     * @return Comment
     * @throws InvalidCommentException
     */
    public function findById(CommentId $commentId): Comment {
        if (!array_key_exists($commentId->__toString(), $this->map)) {
            throw new InvalidCommentException(sprintf("Comment %s doesn't exists", $commentId));
        }

        return $this->map[$commentId->__toString()];
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return array_values($this->map);
    }

    /**
     * @param Comment $comment
     */
    public function save(Comment $comment) {
        $this->map[$comment->id()->__toString()] = $comment;
    }
}
