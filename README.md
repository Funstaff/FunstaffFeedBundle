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
                category:       [cat1, cat2, cat3]
                docs:           ~
                cloud:          [
                                    domain: "rpc.sys.com"
                                    port: "80"
                                    path: "/RPC2"
                                    registerProcedure: "pingMe"
                                    protocol="soap"
                                ]
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

Implement FeedItemInterface on your entity and add 3 mandatories methods:
    - getFeedTitle
    - getFeedLink
    - getFeedDescription

    use Funstaff\FeedBundle\Feed\FeedItemInterface;
    
    class New implements FeedItemInterface
    {
        ...
        function getFeedTitle()
        {
            return $this->title;
        }
        
        function getFeedLink()
        {
            return array('id' => $this->id);
        }
        
        function getFeedDescription()
        {
            return $this->abstract;
        }
    }

Another fields are optionals.


In your controller:

    $results = $this->get('doctrine')
                ->getRepository('FooBarBundle:Foo')
                ->findAll();
    
    $feed = $this->get('funstaff_feed.factory')
                ->createFeed('FeedTitle', '201')
                ->addItems($results, 'FooShow')
                ->render();
    
    $response = new Response($feed);
    $response->headers->set('Content-Type', 'text/xml');

