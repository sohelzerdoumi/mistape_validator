<?php
/**
 * Created by Sohel Zerdoumi.
 * Date: 12/07/18
 */

namespace MistapeValidator;

class MistapeCorrector
{
    /**
     * @var Mistape
     */
    private $mistape;

    public function __construct(Mistape $mistape)
    {
        $this->mistape = $mistape;
    }

    /**
     * Can we find a single occurence of selected text?
     *
     * @return bool
     */
    public function canAutoFix()
    {
        $post         = $this->mistape->getPost();
        $selection    = $this->mistape->getSelection();
        $nbOccurences = substr_count($post->post_content, $selection);

        return $nbOccurences == 1;
    }

    /**
     * @return int|\WP_Error
     */
    public function autofix()
    {
        $post        = $this->mistape->getPost();
        $selection   = $this->mistape->getSelection();
        $correctText = $this->mistape->getComment();
        $content     = str_replace($selection, $correctText, $post->post_content);

        $isFixed = wp_update_post([
            'ID'           => $post->ID,
            'post_content' => $content
        ]);

        return $isFixed;
    }

    /**
     * Preview old content
     *
     * @return mixed
     */
    public function renderContext()
    {
        $context   = htmlspecialchars($this->mistape->getSelectionContext());
        $selection = htmlspecialchars($this->mistape->getSelection());
        $selection = '<div class="mistape-text-danger">' . $selection . '</div>';
        $output    = str_replace($this->mistape->getSelection(), $selection, $context);

        return $output;
    }

    /**
     * Preview new content
     *
     * @return mixed
     */
    public function renderAutoFix()
    {
        $context     = htmlspecialchars($this->mistape->getSelectionContext());
        $correctText = htmlspecialchars($this->mistape->getComment());
        $correctText = '<div class="mistape-text-success">' . $correctText . '</div>';
        $output      = str_replace($this->mistape->getSelection(), $correctText, $context);

        return $output;
    }
}