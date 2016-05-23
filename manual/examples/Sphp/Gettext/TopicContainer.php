<?php
namespace Sphp\Gettext;

$messageCont1 = (new MessageList())
		->insert(new Message("%s message", ["First"]))
		->insert(new Message("Second message"))
		->insert(new Message("Third message"))
		->insertMessage("%s", ["Fourth message"])
		->insert(new Message("Fifth message"));
$messageCont2 = (new MessageList())
		->insert(new Message("Sixth message"));
$messageCont3 = (new MessageList())
		->merge($messageCont1)
		->merge($messageCont2)
		->insert(new Message("Seventh message: counter: %d", [$messageCont1->count()]));
$topicCont = (new TopicList())
		->set("Topic 1", $messageCont1)
		->set("Topic 2", $messageCont2)
		->set("Topic 3", $messageCont3)
		->set("Topic 3", $messageCont2);
echo $topicCont . "\n";
echo "Topics: " . $topicCont->count() . ", Messages: "
		. $topicCont->count(TopicList::COUNT_MESSAGES);

?>