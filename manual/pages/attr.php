<p><button class="button" data-open="exampleModal2">Click me for a modal</button></p>

<!-- This is the first modal -->
<div class="reveal" id="exampleModal2" data-reveal data-multiple-opened="true">
  <h1>Awesome!</h1>
  <p class="lead">I have another modal inside of me!</p>
  <button class="button" data-open="exampleModal3">Click me for another modal!</button>
  <button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
  <div class="reveal" id="exampleModal3" data-reveal data-multiple-opened="true">
    <h2>ANOTHER MODAL!!!</h2>
    <button class="close-button" data-close aria-label="Close reveal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</div>

<!-- This is the nested modal -->

