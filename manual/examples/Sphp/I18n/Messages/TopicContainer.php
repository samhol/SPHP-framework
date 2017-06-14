<?php

namespace Sphp\I18n\Messages; 

$messageCont1 = (new PrioritizedMessageList())
        ->insert(Message::singular("%s message", ["First"]))
        ->insert(Message::singular("Second message"))
        ->insert(Message::singular("Third message"))
        ->insert(Message::singular("%s", ["Fourth message"]))
        ->insert(Message::singular("Fifth message"));
$messageCont2 = (new PrioritizedMessageList())
        ->insert(Message::singular("Sixth message"));
$messageCont3 = (new PrioritizedMessageList())
        ->merge($messageCont1)
        ->merge($messageCont2)
        ->insert(Message::singular("Seventh message: counter: %d", [$messageCont1->count()]));
$topicCont = (new TopicList())
        ->set("Topic 1", $messageCont1)
        ->set("Topic 2", $messageCont2)
        ->set("Topic 3", $messageCont3)
        ->set("Topic 3", $messageCont2);
echo $topicCont . "\n";
echo "Topics: " . $topicCont->count() . ", Messages: "
 . $topicCont->count(TopicList::COUNT_MESSAGES);
