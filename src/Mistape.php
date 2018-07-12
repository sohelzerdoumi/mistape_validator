<?php
/**
 * Created by Sohel Zerdoumi.
 * Date: 11/07/18
 */

namespace MistapeValidator;

/**
 * Class Mistape
 * @package MistapeValidator
 *
 * Représente une proposition de correction du plugin Mistape
 */
class Mistape
{
    const STATUS_PENDING  = 'pending';
    const STATUS_REJECTED = 'rejected';
    const STATUS_ACCEPTED = 'accpeted';

    /**
     * @var int
     */
    protected $ID;
    /**
     * @var int
     */
    protected $blog_id;
    /**
     * @var int
     */
    protected $post_id;

    /**
     * @var null|\WP_Post
     */
    protected $post = null;
    /**
     * @var int
     */
    protected $post_author;
    /**
     * @var int|null
     */
    protected $reporter_user_id;

    /**
     * @var string
     */
    protected $reporter_IP;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var \DateTime
     */
    protected $date_gmp;
    /**
     * @var string
     */
    protected $selection;
    /**
     * @var string
     */
    protected $selection_word;
    /**
     * @var string
     */
    protected $selection_replace_context;
    /**
     * @var string
     */
    protected $selection_context;
    /**
     * @var string
     */
    protected $comment;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var string
     */
    protected $agent;
    /**
     * @var string
     */
    protected $language;
    /**
     * @var string
     */
    protected $status;
    /**
     * @var string
     */
    protected $token;

    /**
     * @return int
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param int $ID
     * @return Mistape
     */
    public function setID($ID)
    {
        $this->ID = $ID;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlogId()
    {
        return $this->blog_id;
    }

    /**
     * @param int $blog_id
     * @return Mistape
     */
    public function setBlogId($blog_id)
    {
        $this->blog_id = $blog_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @return false|\WP_Post
     */
    public function getPost()
    {
        if (!$this->post) {
            $this->post = \WP_Post::get_instance($this->post_id);
        }
        return $this->post;
    }

    /**
     * @param int $post_id
     * @return Mistape
     */
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostAuthor()
    {
        return $this->post_author;
    }

    /**
     * @param int $post_author
     * @return Mistape
     */
    public function setPostAuthor($post_author)
    {
        $this->post_author = $post_author;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getReporterUserId()
    {
        return $this->reporter_user_id;
    }

    /**
     * @param int|null $reporter_user_id
     * @return Mistape
     */
    public function setReporterUserId($reporter_user_id)
    {
        $this->reporter_user_id = $reporter_user_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getReporterIP()
    {
        return $this->reporter_IP;
    }

    /**
     * @param string $reporter_IP
     * @return Mistape
     */
    public function setReporterIP($reporter_IP)
    {
        $this->reporter_IP = $reporter_IP;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Mistape
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateGmp()
    {
        return $this->date_gmp;
    }

    /**
     * @param \DateTime $date_gmp
     * @return Mistape
     */
    public function setDateGmp($date_gmp)
    {
        $this->date_gmp = $date_gmp;
        return $this;
    }

    /**
     * @return string
     */
    public function getSelection()
    {
        return $this->selection;
    }

    /**
     * @param string $selection
     * @return Mistape
     */
    public function setSelection($selection)
    {
        $this->selection = $selection;
        return $this;
    }

    /**
     * @return string
     */
    public function getSelectionWord()
    {
        return $this->selection_word;
    }

    /**
     * @param string $selection_word
     * @return Mistape
     */
    public function setSelectionWord($selection_word)
    {
        $this->selection_word = $selection_word;
        return $this;
    }

    /**
     * @return string
     */
    public function getSelectionReplaceContext()
    {
        return $this->selection_replace_context;
    }

    /**
     * @param string $selection_replace_context
     * @return Mistape
     */
    public function setSelectionReplaceContext($selection_replace_context)
    {
        $this->selection_replace_context = $selection_replace_context;
        return $this;
    }

    /**
     * @return string
     */
    public function getSelectionContext()
    {
        return $this->selection_context;
    }

    /**
     * @param string $selection_context
     * @return Mistape
     */
    public function setSelectionContext($selection_context)
    {
        $this->selection_context = $selection_context;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Mistape
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Mistape
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @param string $agent
     * @return Mistape
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return Mistape
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Mistape
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Mistape
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }
}