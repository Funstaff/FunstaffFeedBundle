<?php

namespace Funstaff\FeedBundle\Feed;

use Funstaff\FeedBundle\Renderer\RendererInterface;
use Funstaff\FeedBundle\Feed\FeedItemInterface;

/**
 * FeedInterface
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
interface FeedInterface
{
    function __construct($channel, RendererInterface $renderer);

    function getChannel();

    function setTitle($title);

    function getTitle();

    function setDescription($description);

    function getDescription();

    function setLink($link);

    function getLink();

    function setLanguage($language);

    function getLanguage();

    function setCopyright($copyright);

    function getCopyright();

    function setManagingEditor($editor);

    function getManagingEditor();

    function setWebMaster($webmaster);

    function getWebMaster();

    function setPubDate($date);

    function getPubDate();

    function setLastBuildDate($date);

    function getLastBuildDate();

    function setCategory($category);

    function getCategory();

    function setGenerator($generator);

    function getGenerator();

    function setDocs($docs);

    function getDocs();

    function setCloud($cloud);

    function getCloud();

    function setTtl($ttl);

    function getTtl();

    function setImage($image);

    function getImage();

    function setRating($rating);

    function getRating();

    function setTextInput($textInput);

    function getTextInput();

    function setSkipHours($skipHours);

    function getSkipHours();

    function setSkipDays($skipDays);

    function getSkipDays();

    function setEncoding($encoding);

    function getEncoding();

    function getCollection();

    function addItem(FeedItemInterface $item, $routingName);

    function render();
}