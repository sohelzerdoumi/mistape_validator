<?php
/**
 * Created by Sohel Zerdoumi.
 * Date: 11/07/18
 */

namespace MistapeValidator;

class MistapeDB
{
    public static function find($mistapeId)
    {
        global $wpdb;
        $table_name = $wpdb->base_prefix . \Deco_Mistape_Abstract::DB_TABLE;
        $query      = "SELECT * FROM $table_name  WHERE ID = %d";
        $mistape    = $wpdb->get_row($wpdb->prepare($query, $mistapeId));

        return static::build_mistape($mistape);
    }

    /**
     * Return pending mistape
     *
     * @return array|Mistape[]
     */
    public static function findAllPending()
    {
        return static::findBy(['status' => Mistape::STATUS_PENDING]);
    }

    /**
     * @param Mistape $mistape
     * @param string  $status
     * @return false|int
     */
    public static function updateStatus($mistape, $status)
    {
        global $wpdb;

        $table_name = $wpdb->base_prefix . \Deco_Mistape_Abstract::DB_TABLE;
        $query      = "UPDATE $table_name SET status = %s WHERE ID = %s";

        $sqlQuery = $wpdb->prepare($query, [$status, $mistape->getID()]);

        return $wpdb->query($sqlQuery);
    }

    /**
     * @param array $criteria
     * @param null  $order
     * @return array|Mistape[]
     */
    public static function findBy($criteria = [], $order = null)
    {
        global $wpdb;
        $table_name = $wpdb->base_prefix . \Deco_Mistape_Abstract::DB_TABLE;
        $query      = "SELECT * FROM $table_name ";

        $wheres = [];
        $values = array_values($criteria);
        foreach ($criteria as $column => $value) {
            $wheres [] = " $column = %s";
        }
        if (count($wheres) > 0) {
            $query .= ' WHERE ' . implode(' AND ', $wheres);
        }

        if ($order) {
            $query .= ' ORDER BY ' . $order;
        }

        $mistapes = $wpdb->get_results($wpdb->prepare($query, $values));
        $mistapes = array_map([get_class(), 'build_mistape'], $mistapes);
        return $mistapes;
    }

    protected static function build_mistape($row)
    {
        $mistape = new Mistape();
        $mistape
            ->setID($row->ID)
            ->setBlogId($row->blog_id)
            ->setPostId($row->post_id)
            ->setPostAuthor($row->post_author)
            ->setReporterUserId($row->reporter_user_id)
            ->setReporterIP($row->reporter_IP)
            ->setDate($row->date)
            ->setSelection($row->selection)
            ->setSelectionWord($row->selection_word)
            ->setSelectionReplaceContext($row->selection_replace_context)
            ->setSelectionContext($row->selection_context)
            ->setComment($row->comment)
            ->setUrl($row->url)
            ->setAgent($row->agent)
            ->setLanguage($row->language)
            ->setStatus($row->status)
            ->setToken($row->token);

        return $mistape;
    }
}