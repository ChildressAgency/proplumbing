/*!
 * theme custom scripts
*/
jQuery(document).ready(function($){
  // animation check
  var $animationElements = $('.animation-trigger');
  var $window = $(window);

  // disable on small devices
  var isMobile = window.matchMedia('(max-width:768px)');
  if(isMobile.matches){
    $animationElements.removeClass('animation-trigger');
  }

  function checkIfInView(){
    var windowHeight = $window.height();
    var windowTopPosition = $window.scrollTop();
    var windowBottomPosition = (windowTopPosition + windowHeight);

    $.each($animationElements, function () {
      var $element = $(this);
      var elementHeight = $element.outerHeight();
      var elementTopPosition = $element.offset().top;
      var elementHeightOffset = elementHeight * (75 / 100);
      var elementBottomPosition = (elementTopPosition + elementHeight);

      if ((elementBottomPosition >= windowTopPosition) &&
        (elementTopPosition <= windowBottomPosition - elementHeightOffset)) {
        $element.addClass('animation-go');
      }
    });
  }

  $window.on('scroll', checkIfInView);

  function normalizeSlideHeights() {
    $('.carousel').each(function () {
      var items = $('.carousel-item', this);
      // reset the height
      items.css('min-height', 0);
      // set the height
      var maxHeight = Math.max.apply(null,
        items.map(function () {
          return $(this).outerHeight()
        }).get());
      items.css('min-height', maxHeight + 'px');
    })
  }

  $(window).on('load resize orientationchange', normalizeSlideHeights);

  //water spray
  var maxParticles = 200000,
    particleSize = 1,
    emissionRate = 20,
    objectSize = 1; // drawSize of emitter/field


  var canvas = document.querySelector('#spray');
  var ctx = canvas.getContext('2d');

  //canvas.width = window.innerWidth;
  //canvas.height = window.innerHeight;
  canvas.width = 1900;
  canvas.height = 500;

  function Particle(point, velocity, acceleration) {
    this.position = point || new Vector(0, 0);
    this.velocity = velocity || new Vector(0, 0);
    this.acceleration = acceleration || new Vector(0, 0);
  }

  Particle.prototype.move = function () {
    this.velocity.add(this.acceleration);
    this.position.add(this.velocity);
  };

  function Field(point, mass) {
    this.position = point;
    this.setMass(mass);
  }

  Field.prototype.setMass = function (mass) {
    this.mass = mass || 100;
    this.drawColor = mass < 0 ? "#f00" : "#0f0";
  }

  function Vector(x, y) {
    this.x = x || 0;
    this.y = y || 0;
  }

  Vector.prototype.add = function (vector) {
    this.x += vector.x;
    this.y += vector.y;
  }

  Vector.prototype.getMagnitude = function () {
    return Math.sqrt(this.x * this.x + this.y * this.y);
  };

  Vector.prototype.getAngle = function () {
    return Math.atan2(this.y, this.x);
  };

  Vector.fromAngle = function (angle, magnitude) {
    return new Vector(magnitude * Math.cos(angle), magnitude * Math.sin(angle));
  };

  function Emitter(point, velocity, spread) {
    this.position = point; // Vector
    this.velocity = velocity; // Vector
    this.spread = spread || Math.PI / 28; // possible angles = velocity +/- spread
    this.drawColor = "#999"; // So we can tell them apart from Fields later
  }

  Emitter.prototype.emitParticle = function () {
    // Use an angle randomized over the spread so we have more of a "spray"
    var angle = this.velocity.getAngle() + this.spread - (Math.random() * this.spread * 2);

    // The magnitude of the emitter's velocity
    var magnitude = this.velocity.getMagnitude();

    // The emitter's position
    var position = new Vector(this.position.x, this.position.y);

    // New velocity based off of the calculated angle and magnitude
    var velocity = Vector.fromAngle(angle, magnitude);

    // return our new Particle!
    return new Particle(position, velocity);
  };

  function addNewParticles() {
    // if we're at our max, stop emitting.
    if (particles.length > maxParticles) return;

    // for each emitter
    for (var i = 0; i < emitters.length; i++) {

      // emit [emissionRate] particles and store them in our particles array
      for (var j = 0; j < emissionRate; j++) {
        particles.push(emitters[i].emitParticle());
      }

    }
  }

  function plotParticles(boundsX, boundsY) {
    // a new array to hold particles within our bounds
    var currentParticles = [];

    for (var i = 0; i < particles.length; i++) {
      var particle = particles[i];
      var pos = particle.position;

      // If we're out of bounds, drop this particle and move on to the next
      if (pos.x < 0 || pos.x > boundsX || pos.y < 0 || pos.y > boundsY) continue;

      // Move our particles
      particle.move();

      // Add this particle to the list of current particles
      currentParticles.push(particle);
    }

    // Update our global particles reference
    particles = currentParticles;
  }

  function drawParticles() {
    ctx.fillStyle = 'rgb(0,0,255)';
    for (var i = 0; i < particles.length; i++) {
      var position = particles[i].position;
      ctx.fillRect(position.x, position.y, particleSize, particleSize);
    }
  }

  var particles = [];

  var midX = canvas.width / 2;
  var midY = canvas.height / 2;

  // Add one emitter located at `{ x : 100, y : 230}` from the origin (top left)
  // that emits at a velocity of `2` shooting out from the right (angle `0`)
  var emitters = [new Emitter(new Vector(midX + 500, midY), Vector.fromAngle(110, 2))];

  function loop() {
    clear();
    update();
    draw();
    queue();
  }

  function clear() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
  }

  function update() {
    addNewParticles();
    plotParticles(canvas.width, canvas.height);
  }

  function draw() {
    drawParticles();
  }

  function queue() {
    window.requestAnimationFrame(loop);
  }

  loop();
  //end water spray
});