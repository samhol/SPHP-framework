<p><button class="button" data-open="exampleModal2">Click me for a modal</button></p>

<!-- This is the first modal -->
<div class="reveal" data-multiple-opened="true" id="exampleModal2" data-reveal>
  <h1>Awesome!</h1>
  <p class="lead">I have another modal inside of me!</p>
  <button class="button" data-open="exampleModal3">Click me for another modal!</button>
  <button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<!-- This is the nested modal -->
<div class="reveal" data-multiple-opened="true"  id="exampleModal3" data-reveal>
  <h2>ANOTHER MODAL!!!</h2>
  <button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>