<?php

/**
 * TranslatorChangerChainInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Gettext;

/**
 * Interface models a piece of chain that is both observer and subject for {@link Translator} changes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TranslatorChangerChainInterface extends TranslatorChangerInterface, TranslatorChangerObserverInterface {

}
