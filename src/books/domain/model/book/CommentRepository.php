<?php

namespace books\domain\model\book;

interface CommentRepository {
    /**
     * @param CommentId $commentId
     *
     * @return Comment
     */
    public function findById(CommentId $commentId): Comment;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Comment $comment
     */
    public function save(Comment $comment);

    /**
     * @param CommentId $commentId
     */
    public function delete(CommentId $commentId);
}
