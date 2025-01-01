var crsr = document.querySelector("#cursor");
var blur = document.querySelector("#cursor-blur");

document.addEventListener("mousemove", function (dets) {
  crsr.style.left = dets.x + "px";
  crsr.style.top = dets.y + "px";
  blur.style.left = dets.x - 250 + "px";
  blur.style.top = dets.y - 250 + "px";
});

var h4all = document.querySelectorAll("#nav h4");
h4all.forEach(function (elem) {
  elem.addEventListener("mouseenter", function () {
    crsr.style.scale = 3;
    crsr.style.border = "1px solid #fff";
    crsr.style.backgroundColor = "transparent";
  });
  elem.addEventListener("mouseleave", function () {
    crsr.style.scale = 1;
    crsr.style.border = "0px solid #95C11E";
    crsr.style.backgroundColor = "#95C11E";
  });
});

gsap.to("#nav", {
  backgroundColor: "#000",
  duration: 0.5,
  height: "110px",
  scrollTrigger: {
    trigger: "#nav",
    scroller: "body",
    // markers:true,
    start: "top -10%",
    end: "top -11%",
    scrub: 1,
  },
});

gsap.to("#main", {
  backgroundColor: "#000",
  scrollTrigger: {
    trigger: "#main",
    scroller: "body",
    // markers: true,
    start: "top -25%",
    end: "top -70%",
    scrub: 2,
  },
});

gsap.from("#about-us img,#about-us-in", {
  y: 90,
  opacity: 0,
  duration: 1,
  scrollTrigger: {
    trigger: "#about-us",
    scroller: "body",
    // markers:true,
    start: "top 70%",
    end: "top 65%",
    scrub: 1,
  },
});
gsap.from(".card", {
  scale: 0.8,
  // opacity:0,
  duration: 1,
  stagger: 0.1,
  scrollTrigger: {
    trigger: ".card",
    scroller: "body",
    // markers:false,
    start: "top 70%",
    end: "top 65%",
    scrub: 1,
  },
});
gsap.from("#colon1", {
  y: -70,
  x: -70,
  scrollTrigger: {
    trigger: "#colon1",
    scroller: "body",
    // markers:true,
    start: "top 55%",
    end: "top 45%",
    scrub: 4,
  },
});
gsap.from("#colon2", {
  y: 70,
  x: 70,
  scrollTrigger: {
    trigger: "#colon1",
    scroller: "body",
    // markers:true,
    start: "top 55%",
    end: "top 45%",
    scrub: 4,
  },
});
gsap.from("#page4 h1", {
  y: 50,
  scrollTrigger: {
    trigger: "#page4 h1",
    scroller: "body",
    // markers:true,
    start: "top 75%",
    end: "top 70%",
    scrub: 3,
  },
});





 // Universe animation parameters
 let scale = 1;  // Initial scale for the zoom effect
 let zPosition = 0;  // Initial z-position to simulate moving into space
 const scaleSpeed = 0.02;  // Speed of scaling (adjust as needed)
 const zSpeed = 5;  // Speed of zooming into the universe

 const universeBackground = document.querySelector('.universe-background');
 const constellationLines = document.getElementById('constellation-lines');
 const constellationStars = document.getElementById('constellation-stars');

 // Function to animate the VR universe effect
 function animateUniverse() {
   scale += scaleSpeed; // Increase the scale over time
   zPosition -= zSpeed; // Move the background deeper into space

   // Update the transform property for smooth zoom effect
   universeBackground.style.transform = `scale(${scale}) translateZ(${zPosition}px)`;

   // Recursively call animateUniverse for smooth animation loop
   requestAnimationFrame(animateUniverse);
 }

 // Generate random stars for constellations
 function generateConstellations() {
   const numberOfStars = 30;
   const stars = [];
   for (let i = 0; i < numberOfStars; i++) {
     const star = document.createElement('div');
     star.classList.add('star');
     const xPos = Math.random() * 100 + '%';
     const yPos = Math.random() * 100 + '%';
     star.style.top = yPos;
     star.style.left = xPos;
     constellationStars.appendChild(star);
     stars.push({ x: parseFloat(xPos), y: parseFloat(yPos) });
   }

   // Connect the stars with lines to simulate constellations
   for (let i = 0; i < stars.length - 1; i++) {
     const line = document.createElement('div');
     line.classList.add('line');
     const startStar = stars[i];
     const endStar = stars[i + 1];

     // Calculate the position and size of the line connecting two stars
     const x1 = startStar.x;
     const y1 = startStar.y;
     const x2 = endStar.x;
     const y2 = endStar.y;

     const distance = Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
     line.style.width = `${distance}%`;

     const angle = Math.atan2(y2 - y1, x2 - x1) * (180 / Math.PI);
     line.style.transform = `rotate(${angle}deg)`;
     line.style.top = `${y1}%`;
     line.style.left = `${x1}%`;

     constellationLines.appendChild(line);
   }
 }

 // Start the universe and constellation animations
 generateConstellations();
 animateUniverse();