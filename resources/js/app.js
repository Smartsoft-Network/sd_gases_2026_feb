import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import Swal from 'sweetalert2';

window.Swal = Swal;

Alpine.plugin(intersect);
window.Alpine = Alpine;

Alpine.start();

// Hero Ripple Effect
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.querySelector('#hero-ripple-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const heroSection = document.querySelector('#home');
    const ripples = [];

    const rippleSettings = {
        maxSize: 150,
        animationSpeed: 2.5,
        strokeColor: [200, 230, 255], // Oxygen Blue
    };

    const canvasSettings = {
        blur: 5, // Back to subtle blur for ring look
        ratio: window.devicePixelRatio || 1,
    };

    function Coords(x, y) {
        this.x = x || null;
        this.y = y || null;
    }

    const Ripple = function Ripple(x, y, circleSize, ctx) {
        this.position = new Coords(x, y);
        this.circleSize = circleSize;
        this.maxSize = rippleSettings.maxSize;
        this.opacity = 0.7; // Slightly more visible for rings
        this.ctx = ctx;
        this.animationSpeed = rippleSettings.animationSpeed;
        this.opacityStep = (this.animationSpeed / (this.maxSize - circleSize)) / 1.5;
    };

    Ripple.prototype = {
        update: function update() {
            this.circleSize = this.circleSize + this.animationSpeed;
            this.opacity = Math.max(0, this.opacity - this.opacityStep);
        },
        draw: function draw() {
            this.ctx.beginPath();
            // Using stroke for the "ring" effect like the first version
            this.ctx.strokeStyle = `rgba(${rippleSettings.strokeColor[0]}, ${rippleSettings.strokeColor[1]}, ${rippleSettings.strokeColor[2]}, ${this.opacity})`;
            this.ctx.lineWidth = 2;
            this.ctx.arc(this.position.x, this.position.y, this.circleSize, 0, 2 * Math.PI);
            this.ctx.stroke();
        },
    };

    const resize = () => {
        const width = heroSection.clientWidth;
        const height = heroSection.clientHeight;
        canvas.width = width * canvasSettings.ratio;
        canvas.height = height * canvasSettings.ratio;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;
        ctx.scale(canvasSettings.ratio, canvasSettings.ratio);
        canvas.style.filter = `blur(${canvasSettings.blur}px)`;
    };

    window.addEventListener('resize', resize);
    resize();

    const canvasMouseOver = (e) => {
        const rect = canvas.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        ripples.unshift(new Ripple(x, y, 2, ctx));
        
        // Limit number of ripples for performance
        if (ripples.length > 50) {
            ripples.pop();
        }
    };

    const animation = () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        for (let i = ripples.length - 1; i >= 0; i -= 1) {
            const r = ripples[i];
            r.update();
            r.draw();

            if (r.opacity <= 0) {
                ripples.splice(i, 1);
            }
        }
        requestAnimationFrame(animation);
    };

    animation();
    heroSection.addEventListener('mousemove', canvasMouseOver);
});
