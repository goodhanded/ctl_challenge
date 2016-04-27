<?php

namespace Goodhanded\PipelineBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Goodhanded\PipelineBundle\Model\AbstractItem;
use Goodhanded\PipelineBundle\Entity\Tracker;
use Goodhanded\PipelineBundle\Entity\Item;
use Goodhanded\PipelineBundle\Event\TrackEvent;

// This class is typically created by the bundle consumer
class TestItem extends AbstractItem {}

class TrackerTest extends WebTestCase
{

    // Constants
    const ITEM_NAME = "turtles";
    const ITEM_CLASS = "\Goodhanded\PipelineBundle\Tests\Entity\TestItem";
    const ORIGINAL_COUNT = 10;
    const COUNT_CHANGE = 42;

    /**
     * This method tests calling track() on a new item.
     */
    public function testNonExistingItem()
    {
        // Set up stub dependencies
        $itemRepository = $this->stubItemRepository();
        $entityManager = $this->stubEntityManager($itemRepository);
        $dispatcher = $this->stubDispatcher();

        // Expect findOneBy to be called once. It will return null.
        $itemRepository->expects($this->once())->method('findOneBy');

        // Test the dispatched event.
        $dispatcher->expects($this->once())
            ->method('dispatch')
            ->will($this->returnCallback(function ($eventName, $event) {
                \PHPUnit_Framework_Assert::assertEquals(TrackEvent::NAME, $eventName);
                \PHPUnit_Framework_Assert::assertEquals(TrackerTest::ITEM_NAME, $event->getItem()->getName());
            }));
    
        // Init unit under test
        $tracker = new Tracker($entityManager);
        $tracker->setItemClass(TrackerTest::ITEM_CLASS);
        $tracker->setDispatcher($dispatcher);

        // Call track method
        $tracker->track(TrackerTest::ITEM_NAME, TrackerTest::COUNT_CHANGE);
    }

    /**
     * This method tests calling track() on a pre-existing item.
     */
    public function testExistingItem()
    {
        // We'll return this item as if it had already existed in the DB.
        $itemClass = TrackerTest::ITEM_CLASS;
        $item = new $itemClass();
        $item->setName(TrackerTest::ITEM_NAME);
        $item->setCount(TrackerTest::ORIGINAL_COUNT);

        // Set up stub dependencies
        $itemRepository = $this->stubItemRepository();
        $entityManager = $this->stubEntityManager($itemRepository);
        $dispatcher = $this->stubDispatcher();

        // Expect the mock item to be returned
        $itemRepository->expects($this->once())
            ->method('findOneBy')
            ->will($this->returnValue($item));

        // Test the dispatched event
        $dispatcher->expects($this->once())
            ->method('dispatch')
            ->will($this->returnCallback(function ($eventName, $event) {
                \PHPUnit_Framework_Assert::assertEquals(TrackEvent::NAME, $eventName);
                \PHPUnit_Framework_Assert::assertEquals(TrackerTest::ITEM_NAME, $event->getItem()->getName());
                \PHPUnit_Framework_Assert::assertEquals(
                    TrackerTest::ORIGINAL_COUNT + TrackerTest::COUNT_CHANGE, 
                    $event->getItem()->getCount()
                );
            }));
    
        // Init unit under test
        $tracker = new Tracker($entityManager);
        $tracker->setItemClass(TrackerTest::ITEM_CLASS);
        $tracker->setDispatcher($dispatcher);

        // Call track method
        $tracker->track(TrackerTest::ITEM_NAME, TrackerTest::COUNT_CHANGE);
    }


    /***************************
     * Stubbing methods
     ***************************/

    private function stubItemRepository()
    {
        return $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function stubEntityManager($itemRepository)
    {
        $entityManager = $this
            ->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($itemRepository));

        return $entityManager;
    }

    private function stubDispatcher()
    {
        return $this->getMockBuilder('\Symfony\Component\EventDispatcher\EventDispatcher')
            ->disableOriginalConstructor()
            ->getMock();
    }

}
