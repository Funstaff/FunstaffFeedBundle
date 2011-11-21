<?php

namespace Funstaff\FeedBundle\Feed;

/**
 * FeedItemInterface
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
interface FeedItemInterface
{
    function getFeedTitle();

    function getFeedLink();

    function getFeedDescription();
}