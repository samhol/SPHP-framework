<?php

use Sphp\Stdlib\Networks\URL;
use Sphp\Html\Media\Icons\FA;
use Sphp\Html\Media\Icons\FaIcon;

$currentUrl = URL::getCurrentURL();
?>

<div class="manual-footer sitemap-container">
  <footer class="sitemap">
    <div class="grid-container">
      <div class="grid-x">
        <div class="cell auto">
          <?php include 'footerLinks.php'; ?>
        </div>
      </div>
    </div>
  </footer>
</div>
<div class="manual-footer social-container">
  <footer class="social">
    <div class="footer-left">
      <div class="contact-details">
        <div class="media-object">
          <div class="media-object-section">
            <div class="thumbnail">
              <img src="http://data.samiholck.com/images/face.jpg" width="74" height="100" alt="Photo of Sami Holck">
            </div>
          </div>
          <div class="media-object-section main-section">
            <h6>Contact information:</h6>
            <ul class="fa-ul">
              <li><span class="fa-li"><?php (new FaIcon('fas fa-user-tie', 'name'))->printHtml() ?></span> Sami Holck</li>
              <li><span class="fa-li"><?php FA::phone('phonenumber')->printHtml() ?></span> +358 44 298 6738</li>
              <li><span class="fa-li"><?php FA::envelope('Email address')->printHtml() ?></span> sami.holck@gmail.com</li>
              <li><span class="fa-li"><?php FA::get('fa fa-map-marker-alt', 'Email address')->printHtml() ?></span> Rakuunatie 59 A3, Turku, Finland</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-right">
      <h6>Follow</h6>
      <a href="https://github.com/samhol">
        <i class="fab fa-github-square fa-4x" aria-hidden="true"></i>
        <span class="show-for-sr">GitHub page</span>
      </a>
      <a href="https://www.facebook.com/sami.holck">
        <i class="fab fa-facebook-square fa-4x" aria-hidden="true"></i>
        <span class="show-for-sr">Facebook page</span>
      </a>
      <a href="https://plus.google.com/b/113942361282002156141/113942361282002156141">
        <i class="fab fa-google-plus-square fa-4x" aria-hidden="true"></i>
        <span class="show-for-sr">Google plus page</span>
      </a>
      <a href="https://twitter.com/SPHPframework">
        <i class="fab fa-twitter-square fa-4x" aria-hidden="true"></i>
        <span class="show-for-sr">Twitter page</span>
      </a>
    </div>
  </footer>
</div>
<div class="manual-footer copyright-details-container">
  <footer class="copyright-details">
    <p>
      <?php

      use Sphp\Stdlib\StopWatch;
      ?>
      Copyright &copy; <?php echo date('Y'); ?> by <b>Sami Holck</b>.
      <span class="separator">||</span>
      <a href="/license.php" target="license" rel="copyright"><b>MIT license</b></a>
      <span class="separator">||</span>
      <b>Script executed in:</b>
      <i><?php echo number_format(StopWatch::getExecutionTime(), 2) ?> seconds</i>
      <span class="separator">||</span> <b>PHP Peak memory:</b>
      <i><?php echo number_format(memory_get_usage(true) / 1048576, 2) . " MB\n" ?></i>
    </p>
    <ul class="tech-links-list">
      <li>
        <a href="http://www.php.net/" title="<?php echo 'PHP ' . phpversion(); ?>">
          <svg viewBox="0 0 128 128">
          <path d="M64 33.039c-33.74 0-61.094 13.862-61.094 30.961s27.354 30.961 61.094 30.961 61.094-13.862 61.094-30.961-27.354-30.961-61.094-30.961zm-15.897 36.993c-1.458 1.364-3.077 1.927-4.86 2.507-1.783.581-4.052.461-6.811.461h-6.253l-1.733 10h-7.301l6.515-34h14.04c4.224 0 7.305 1.215 9.242 3.432 1.937 2.217 2.519 5.364 1.747 9.337-.319 1.637-.856 3.159-1.614 4.515-.759 1.357-1.75 2.624-2.972 3.748zm21.311 2.968l2.881-14.42c.328-1.688.208-2.942-.361-3.555-.57-.614-1.782-1.025-3.635-1.025h-5.79l-3.731 19h-7.244l6.515-33h7.244l-1.732 9h6.453c4.061 0 6.861.815 8.402 2.231s2.003 3.356 1.387 6.528l-3.031 15.241h-7.358zm40.259-11.178c-.318 1.637-.856 3.133-1.613 4.488-.758 1.357-1.748 2.598-2.971 3.722-1.458 1.364-3.078 1.927-4.86 2.507-1.782.581-4.053.461-6.812.461h-6.253l-1.732 10h-7.301l6.514-34h14.041c4.224 0 7.305 1.215 9.241 3.432 1.935 2.217 2.518 5.418 1.746 9.39zM95.919 54h-5.001l-2.727 14h4.442c2.942 0 5.136-.29 6.576-1.4 1.442-1.108 2.413-2.828 2.918-5.421.484-2.491.264-4.434-.66-5.458-.925-1.024-2.774-1.721-5.548-1.721zM38.934 54h-5.002l-2.727 14h4.441c2.943 0 5.136-.29 6.577-1.4 1.441-1.108 2.413-2.828 2.917-5.421.484-2.491.264-4.434-.66-5.458s-2.772-1.721-5.546-1.721z"></path>
          </svg>
          <span class="show-for-sr"><?php echo 'PHP ' . phpversion(); ?></span>
        </a>
      </li>

      <li>
        <a href="http://validator.w3.org/check?uri=<?php echo $currentUrl; ?>">
          <svg viewBox="0 0 128 128">
          <path d="M9.032 2l10.005 112.093 44.896 12.401 45.02-12.387 10.015-112.107h-109.936zm89.126 26.539l-.627 7.172-.276 3.289h-52.665000000000006l1.257 14h50.156000000000006l-.336 3.471-3.233 36.119-.238 2.27-28.196 7.749v.002l-.034.018-28.177-7.423-1.913-21.206h13.815000000000001l.979 10.919 15.287 4.081h.043v-.546l15.355-3.875 1.604-17.579h-47.698l-3.383-38.117-.329-3.883h68.939l-.33 3.539z"></path>
          </svg>
          <span class="show-for-sr">HTML5 validator</span>
        </a>
      </li>

      <li>
        <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo $currentUrl; ?>&profile=css3&usermedium=all&warning=1&vextwarning=&lang=en">
          <svg viewBox="0 0 128 128">
          <path d="M8.76 1l10.055 112.883 45.118 12.58 45.244-12.626 10.063-112.837h-110.48zm89.591 25.862l-3.347 37.605.01.203-.014.467v-.004l-2.378 26.294-.262 2.336-28.36 7.844v.001l-.022.019-28.311-7.888-1.917-21.739h13.883l.985 11.054 15.386 4.17-.004.008v-.002l15.443-4.229 1.632-18.001h-32.282999999999994l-.277-3.043-.631-7.129-.331-3.828h34.748999999999995l1.264-14h-52.926l-.277-3.041-.63-7.131-.332-3.828h69.281l-.331 3.862z"></path>
          </svg>
          <span class="show-for-sr">CSS validator</span>
        </a>
      </li>
      <li>
        <a href="https://jquery.com/" class="jQuery">
          <svg viewBox="0 0 128 128">
          <path d="M47.961 79.02l.193.094.344.166c.439.209.882.416 1.329.615l.281.125c.513.225 1.029.439 1.551.645l.378.148c.482.188.972.37 1.463.543l.184.063c.539.188 1.083.363 1.632.534l.395.117c.558.169 1.109.37 1.685.477 36.554 6.665 47.171-21.967 47.171-21.967-8.918 11.618-24.747 14.683-39.745 11.271-.568-.128-1.12-.306-1.674-.47l-.417-.126c-.541-.166-1.079-.341-1.612-.524l-.221-.08c-.478-.168-.951-.346-1.421-.527l-.398-.156c-.516-.203-1.028-.416-1.534-.638l-.307-.136c-.435-.197-.866-.396-1.294-.602l-.375-.18c-.336-.164-.669-.339-1.001-.51l-.668-.35c-.405-.217-.803-.442-1.199-.673l-.405-.226c-.527-.311-1.048-.632-1.563-.958l-.421-.28c-.374-.241-.746-.486-1.112-.739l-.358-.252c-.354-.25-.704-.503-1.051-.76l-.466-.353c-.318-.243-.635-.488-.948-.74l-.423-.34c-.398-.328-.792-.657-1.182-.995l-.129-.109c-.423-.368-.836-.747-1.244-1.127l-.35-.337c-.303-.287-.6-.577-.893-.874l-.35-.35c-.372-.381-.737-.767-1.095-1.158l-.054-.058c-.379-.414-.749-.837-1.111-1.264l-.291-.346c-.27-.325-.538-.655-.799-.988l-.293-.364c-.315-.408-.622-.815-.923-1.229-8.326-11.358-11.318-27.023-4.663-39.888l-5.899 7.482c-7.559 10.863-6.617 24.997-.844 36.541l.423.821.271.52.168.299.301.539c.179.316.362.63.55.944l.315.519c.208.336.421.668.64 1l.272.422c.301.448.609.896.926 1.336l.027.035.156.211c.275.379.558.753.844 1.123l.318.404c.255.321.516.641.78.959l.298.355c.355.419.717.835 1.087 1.242l.022.023.042.046c.36.394.73.778 1.104 1.164l.354.357c.29.292.584.579.882.865l.361.343c.397.374.798.741 1.208 1.101l.02.015.21.18c.361.312.729.623 1.099.928l.455.362c.302.242.608.481.916.716l.489.372c.34.25.682.496 1.027.737l.375.266.103.073c.328.226.663.442.998.659l.432.288c.513.325 1.035.646 1.562.956l.432.244c.388.223.777.442 1.172.656l.648.336.84.437zM51.654 42.225c.819 1.174 1.726 2.57 2.813 3.514.394.434.806.856 1.226 1.273l.324.318c.409.396.824.785 1.252 1.164l.052.044.012.013c.475.416.965.816 1.463 1.21l.333.26c.5.383 1.009.759 1.531 1.118l.045.033.698.46.332.22c.373.238.75.472 1.135.694l.16.093c.331.191.667.379 1.003.561l.356.187.702.363.106.048c.482.237.968.465 1.464.682l.323.133c.396.168.797.333 1.199.487l.514.188c.366.136.732.26 1.102.383l.499.16c.526.163 1.045.369 1.593.46 28.222 4.677 34.738-17.054 34.738-17.054-5.874 8.459-17.248 12.494-29.386 9.344-.539-.142-1.071-.295-1.598-.462l-.481-.155c-.375-.121-.748-.25-1.118-.385l-.504-.188c-.405-.156-.807-.317-1.204-.485l-.324-.138c-.498-.217-.989-.445-1.472-.685l-.739-.376-.426-.219c-.314-.17-.626-.348-.934-.527l-.223-.127c-.383-.223-.759-.453-1.132-.689l-.341-.229-.732-.484c-.521-.359-1.027-.734-1.525-1.115l-.343-.271c-5.313-4.193-9.524-9.927-11.527-16.428-2.098-6.74-1.646-14.308 1.989-20.449l-4.466 6.306c-5.466 7.865-5.169 18.396-.905 26.715.714 1.393 1.517 2.747 2.416 4.035zM81.401 32.494l.701.243.309.098c.333.104.662.226 1.005.29 15.583 3.011 19.811-7.997 20.936-9.617-3.703 5.331-9.925 6.61-17.56 4.757-.603-.146-1.266-.363-1.848-.57-.745-.266-1.479-.568-2.193-.91-1.356-.652-2.648-1.441-3.846-2.347-6.832-5.185-11.076-15.072-6.618-23.126l-2.412 3.324c-3.222 4.743-3.539 10.633-1.303 15.869 2.358 5.56 7.19 9.92 12.829 11.989zM66.359 96.295h-4.226c-.234 0-.467.188-.517.417l-1.5 6.94-1.5 6.94c-.049.229-.282.417-.516.417h-2.991c-2.959 0-2.617-2.047-2.011-4.851l.018-.085.066-.354.012-.066.135-.72.145-.771.154-.785.682-3.332.683-3.332c.047-.23-.107-.419-.341-.419h-4.337c-.234 0-.466.188-.514.418l-.933 4.424-.932 4.425-.002.006-.086.412c-1.074 4.903-.79 9.58 5.048 9.727l.17.003h9.163c.234 0 .467-.188.516-.417l1.976-9.289 1.976-9.29c.049-.23-.103-.417-.338-.418zM21.103 96.246h-4.64c-.235 0-.469.188-.521.416l-.44 1.942-.44 1.942c-.051.229.098.416.333.416h4.676c.235 0 .468-.188.518-.417l.425-1.941.425-1.941c.049-.229-.101-.417-.336-.417zM19.757 102.29h-4.677c-.234 0-.469.188-.521.416l-.657 2.91-.656 2.909-.183.834-.631 2.97-.63 2.971c-.049.229-.15.599-.225.821 0 0-.874 2.6-2.343 2.57l-.184-.004-1.271-.023h-.001c-.234-.003-.469.18-.524.407l-.485 2.039-.484 2.038c-.055.228.093.416.326.42.833.01 2.699.031 3.828.031 3.669 0 5.604-2.033 6.843-7.883l1.451-6.714 1.361-6.297c.049-.227-.103-.415-.337-.415zM105.874 100.716l-.194-.801-.191-.82-.097-.414c-.38-1.477-1.495-2.328-3.917-2.328l-3.77-.004-3.472-.005h-3.907c-.234 0-.466.188-.515.417l-.173.816-.204.964-.057.271-1.759 8.24-1.67 7.822c-.05.23-.066.512-.038.626.028.115.479.209.713.209h3.524c.235 0 .532-.042.66-.094s.317-.513.364-.742l.626-3.099.627-3.1.001-.005.084-.413.76-3.56.671-3.144c.05-.229.281-.416.515-.417l11.089-.005c.235.002.383-.185.33-.414zM120.149 93.476l-.854.003h-3.549c-.235 0-.536.159-.667.353l-7.849 11.498c-.132.194-.283.166-.335-.062l-.578-2.533c-.052-.229-.287-.416-.522-.416h-5.045c-.235 0-.374.184-.31.409l2.261 7.921c.064.226.069.596.011.824l-.985 3.833c-.059.228.085.413.32.413h4.987c.234 0 .474-.186.532-.413l.986-3.833c.058-.229.221-.567.363-.755l12.742-16.911c.142-.188.065-.341-.169-.339l-1.339.008zM80.063 103.395v-.004c-.029.254-.264.441-.499.441h-6.397c-.222 0-.334-.15-.301-.336l.006-.015-.004.002.003-.021.029-.109c.611-1.624 1.855-2.69 4.194-2.69 2.634-.001 3.148 1.285 2.969 2.732zm-1.877-7.384c-8.211 0-10.157 4.984-11.249 10.015-1.091 5.128-.998 9.921 7.5 9.921h1.03l.256-.001h.06l1.02-.003h.018c2.244-.009 4.495-.026 5.406-.033.233-.004.461-.191.509-.42l.344-1.681.067-.327.41-2.006c.047-.229-.106-.418-.341-.418h-7.639c-3.039 0-3.941-.807-3.608-3.181h12.211l-.001.001.008-.001c.194-.003.374-.137.445-.315l.029-.106-.001.001c1.813-6.839 1.293-11.445-6.474-11.446zM39.376 103.369l-.116.409v.001l-.922 3.268-.922 3.267c-.063.227-.308.411-.543.411h-4.88c-3.702 0-4.604-2.896-3.702-7.166.901-4.368 2.668-7.083 6.312-7.358 4.98-.376 5.976 3.126 4.773 7.168zm3.348 7.105s2.301-5.588 2.823-8.814c.713-4.319-1.45-10.585-9.804-10.585-8.306 0-11.914 5.981-13.29 12.484-1.376 6.55.427 12.293 8.686 12.246l6.516-.024 6.089-.022c.234-.002.474-.188.534-.414l1.061-4.046c.059-.228-.084-.414-.319-.416l-1.017-.006-1.017-.006c-.199-.001-.313-.131-.289-.302l.027-.095zM83.844 106.733c0 .155-.125.281-.28.281-.154 0-.28-.126-.28-.281 0-.154.125-.279.28-.279.155 0 .28.125.28.279z"></path>
          </svg>
          <span class="show-for-sr">jQuery home</span>
        </a>
      </li>
      <li>
        <a href="https://foundation.zurb.com/" class="foundation">
          <svg viewBox="0 0 128 128">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M116.173 64.1l1.466.472.087-.159c-.8-1.056-1.576-2.191-3.034-2.396-1.061-.149-2.147-.108-3.223-.151.035-.51-.153-.69-.66-.482-.479.196-.973.356-1.458.539-1.163.437-2.321.889-3.491 1.305-.205.073-.461-.001-.693-.007.017-.218 0-.446.057-.653.214-.779.458-1.549.678-2.326.073-.259.11-.529.164-.792l1.105.878c.225-2.741-.326-5.136-1.755-7.449l1.433.08c-.644-1.489-1.602-2.617-2.945-3.412-1.694-1.004-3.604-.986-5.477-1.138-.295-.024-.594-.003-.956-.003 1.423 2.374 2.019 6.36 1.156 7.71l-.479-.807c-1.073 1.737-2.09 3.56-3.281 5.262-1.195 1.708-2.672 3.167-4.715 4.116l.248-1.223c-.304.08-.494.149-.69.179-.509.077-1.037.252-1.526.178-.915-.14-1.809-.418-2.707-.659-.616-.166-1.223-.364-1.834-.547l.001.003-.129-.138c-.713-.499-.598-1.094-.246-1.758.241-.455.412-.947.601-1.428.428-1.093.847-2.19 1.27-3.285.422-.473.9-.907 1.25-1.427.39-.58.686-1.228.978-1.866.209-.458.493-.773.972-.975.277-.116.557-.38.69-.65.246-.496.398-1.041.562-1.574.129-.424-.031-.728-.463-.869l-.53-.174c.046-.18.068-.371.145-.537 1.309-2.798 2.578-5.615 3.952-8.382 1.401-2.823 2.894-5.601 4.375-8.383.314-.591.752-1.116 1.133-1.67.663.044 1.325.115 1.988.129 2.977.062 5.679-.691 7.873-2.805 2.3-2.215 3.884-4.893 4.941-7.893l.214-.543-.416.262c-2.932 2.006-6.098 3.113-9.705 2.532.042-.116.058-.251.128-.346 1.264-1.711 2.527-3.422 3.808-5.121.453-.601.951-1.167 1.472-1.801-.324-.123-.55-.222-.784-.296-1.202-.378-2.401-.768-3.612-1.117-.515-.148-.623-.403-.406-.867.51-1.088 1.007-2.183 1.514-3.272l.567-1.013c-2.968-.561-5.786-.624-8.786-.252v-1.776c-2 .182-2.419.288-3.519.531-1.092.24-2.189.617-3.265.934l-.159-.101 2.521-4.368c-1.306.149-2.527.224-3.72.438-2.393.428-5.106.91-7.484 1.414-1.027.217-2.374.545-3.374.823v-1.882c-1 .271-2.777 1.055-4.489 1.692.35-1.05.814-1.924 1.088-2.805.06-.192.104-.415.111-.624-.09-.033-.145-.106-.229-.094-.733.106-1.447.207-2.173.349-3.778.741-7.366 1.992-10.744 3.853-.384.212-.77.411-1.314.7l-.256-4.037c-2.035.718-3.987 1.66-5.394 3.466l-.801-3.114-.007-.243-.037-.116-.061.069c-.175.202-.368.391-.522.608-1.603 2.258-2.446 4.78-2.602 7.539l-1.29-2.83-1.817 8.597-3.064-3.904c-1.055 2.856-1.744 5.714-2.071 8.766l-2.152-2.427c-1.436 4.394-2.656 8.712-3.108 13.274-1.082-.659-1.744-1.526-2.197-2.582-.654-1.521-.813-3.113-.75-4.745.009-.248-.024-.497-.037-.746l-.182.002c-2.136 7.443-2.69 15.056-2.403 22.787l-2.648-5.041-.178.015c-.179 1.949-.392 3.895-.522 5.847-.081 1.206.121.992-1.032 1.279-3.628.905-7.076 2.207-10.091 4.492-.19.144-.424.229-.638.342l.218.205 3.087 1.154c-1.331 1.479-2.647 2.872-3.88 4.335-1.249 1.482-2.21 3.148-2.933 5.048.691-.288 1.252-.547 1.832-.755.551-.199 1.122-.345 1.683-.514-1.1 1.13-1.926 2.368-2.609 3.694-2.427 4.715-3.288 9.827-3.577 15.037-.188 3.369-.093 6.754.475 10.102.097.571.221 1.138.332 1.707l.25.044 1.505-3.558c.684 3.814.814 7.624.773 11.445l.163.099 1.361-1.659c.188.386.294.542.341.714.714 2.582.905 5.227.714 7.877-.099 1.382-.077 2.723.236 4.062.77 3.284 2.396 6.116 4.642 8.597.447.495 1.069.835 1.622 1.23.262.186.426.116.403-.233l-.053-.029.054.028 1.053.343 1.703.594.078-.16-1.09-2.272-.093-.133.048-.032.048.163c.078.023.18.022.231.072 1.063 1.04 2.415 1.579 3.737 2.171.368.877.972 1.561 1.676 2.161l1.19-.826c.164.203.301.355.417.521.984 1.409 2.332 2.07 4.049 2.001 1.079-.043 2.159-.065 3.239-.09 3.717-.087 7.435-.158 11.151-.262 2.574-.072 5.147-.178 7.72-.29 1.197-.053 2.392-.156 3.703-.243-1.928-5.083-5.942-7.769-10.392-9.673l3.814-1.039c5.522 3.064 11.615 5.078 16.597 9.138l.234-.121-.442-4.497c.308.21.636.418.948.649 1.221.903 2.438 1.813 3.656 2.72l.226.104.084.157c1.831 1.573 3.78 2.779 6.351 2.725 3.55-.075 7.104.002 10.657-.02.271-.001.654-.192.792-.415.8-1.285 1.588-2.582 2.296-3.92 1.776-3.357 3.507-6.738 5.258-10.109l.501-.945c-.789.236-1.471.574-2.148.92-.735.375-1.466.758-2.199 1.137l-.065.055.049-.072c.077-.233.114-.49.238-.695 1.597-2.64 3.143-5.314 4.832-7.895 1.677-2.564 3.631-4.961 4.663-7.897.471-1.342.843-2.718 1.26-4.079l-.019-.016-.122.006c-.75.527-1.463 1.117-2.257 1.565-.956.54-1.98.959-2.975 1.431l-.029.052-.023-.023.052-.028.167-.59.767-2.929c-.307-.018-.436.041-.562.104-2.146 1.086-4.256 2.251-6.445 3.24-3 1.356-5.807 3-8.361 5.074-.863.701-1.688 1.448-2.548 2.189l-.195-.136c-.847-.76-1.69-1.525-2.539-2.283-.532-.476-1.072-.941-1.608-1.413 1.849-2.37 3.333-4.953 4.229-7.822.577-1.848.939-3.763 1.397-5.649l.528-.159c1.439-.516 2.903-.943 4.451-.839.667.045 1.325.236 1.987.361l-.5-1.121-.05-.059.035.01.018.046c.12.024.249.028.357.077 1.15.52 2.272 1.106 3.447 1.559 1.929.742 3.939 1.094 6.018.99.279-.014.478-.039.262-.376.198.052.401.088.592.16 1.534.579 3.131.865 4.752.686 1.493-.165 2.698-.907 3.365-2.371l.475.222c.411-1.152.049-2.229-.161-3.319-.036-.188-.036-.467.075-.585.402-.433.858-.816 1.316-1.238l.281.645c.642-1.068.658-2.241.735-3.546l.618.76.241-.096c-.193-.949-.209-1.983-.622-2.825-.576-1.176-.609-2.122.164-3.21.458-.644.65-1.477 1.054-2.446.074.199.093.312.154.394.048.064.148.089.261.151-.057-1.719-.838-3.115-1.708-4.6z"></path>
          </svg>
          <span class="show-for-sr">Foundation home</span>
        </a>
      </li>
    </ul>

  </footer>
</div>
