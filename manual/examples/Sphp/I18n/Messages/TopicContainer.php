<?php

namespace Sphp\I18n\Messages;
$translator = \Sphp\I18n\Translators::instance()->get('validation');
$messageCont1 = (new TranslatablePriorityList())->setTranslator($translator)
        ->insert(Message::singular("Please insert atleast %s of the following characters (%s)", [3, 'a, b, c, d, e, f']))
        ->insert(Message::singular("Please insert a value"))
        ->insert(Message::singular("Please insert a correct email address"))
        ->insert(Message::singular("Please insert alphabets and numbers only"))
        ->insert(Message::singular("Fifth message"));
$messageCont2 = (new TranslatablePriorityList())
        ->insert(Message::singular("Sixth message"));
$messageCont3 = (new TranslatablePriorityList())
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
