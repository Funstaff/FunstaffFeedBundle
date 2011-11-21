FunstaffFeedBundle
==================

Under development


Configuration
-------------
    funstaff_feed:
        channels:
            FeedTitle:
                title:  'Feed title'
                description:    'Feed Description'
                link:           'http://feed/url'
                language:       ~
                copyright:      ~
                managingEditor: ~
                webMaster:      ~
                pubDate:        ~
                lastBuildDate:  ~
                category:       ~
                docs:           ~
                cloud:          ~
                ttl:            ~
                rating:         ~
                image:          ~
                rating:         ~
                textInput:      ~
                skipHours:      ~
                skipDays:       ~
                encoding:       ~ (default: UTF-8)

The fields title, description and link are mandatory


Use
---
    $results = $this->get('doctrine')
                ->getRepository('FooBarBundle:Foo')
                ->findAll();
    
    $feed = $this->get('funstaff_feed.factory')
                ->createFeed('FeedTitle', '201')
                ->addItems($results, 'FooShow')
                ->render();
    
    $response = new Response($feed);
    $response->headers->set('Content-Type', 'text/xml');

