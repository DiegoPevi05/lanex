<!-- Section-Level Scroll SVG Animator (Lateral Navigation Bar Removed) -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const svgSections = Array.from(document.querySelectorAll(".scroll-svg-section"));
    if (!svgSections.length) return;

    function applySectionProgress(sec, progress) {
        const clamped = Math.max(0, Math.min(1, progress));
        const pct = Math.round(clamped * 100);
        const dashOffset = 100 - pct;

        const mainPath = sec.querySelector(".js-scroll-mainpath");
        const subPath = sec.querySelector(".js-scroll-subpath");
        const spineFill = sec.querySelector(".js-text-spine-fill");
        const rings = sec.querySelectorAll(".js-node-ring");
        const stageBtns = sec.querySelectorAll(".js-stage-btn");
        const stepDots = sec.querySelectorAll(".js-step-dot");
        const scrollActors = sec.querySelectorAll(".js-scroll-actor");

        if (mainPath) mainPath.setAttribute("stroke-dashoffset", String(dashOffset));
        if (subPath) subPath.setAttribute("stroke-dashoffset", String(dashOffset));
        if (spineFill) spineFill.style.height = Math.max(12, pct) + "%";

        // Move friendly illustrated SVG characters / vehicles on scroll
        scrollActors.forEach((actor) => {
            const maxX = parseFloat(actor.getAttribute("data-move-x") || "0");
            const maxY = parseFloat(actor.getAttribute("data-move-y") || "0");
            const curX = (maxX * clamped).toFixed(1);
            const curY = (maxY * clamped).toFixed(1);
            actor.style.transform = `translate(${curX}px, ${curY}px)`;
        });

        // Determine active stage (0, 1, or 2)
        const activeStage = clamped < 0.36 ? 0 : clamped < 0.72 ? 1 : 2;

        // Draw each node's outer SVG ring progressively
        const totalRings = Math.max(1, rings.length);
        rings.forEach((ring, idx) => {
            const thresholdStart = (idx / totalRings) * 0.72;
            const localProg = Math.max(0, Math.min(1, (clamped - thresholdStart) / 0.28));
            ring.setAttribute("stroke-dashoffset", String(Math.round(100 - localProg * 100)));
        });

        stageBtns.forEach((btn, idx) => {
            if (idx <= activeStage) {
                btn.classList.add("border-primary");
            } else {
                btn.classList.remove("border-primary");
            }
        });

        stepDots.forEach((dot, idx) => {
            if (idx <= activeStage) {
                dot.classList.remove("bg-slate-300");
                dot.classList.add("bg-primary", "ring-2", "ring-primary/30");
            } else {
                dot.classList.add("bg-slate-300");
                dot.classList.remove("bg-primary", "ring-2", "ring-primary/30");
            }
        });
    }

    function updateSectionsOnScroll() {
        const winH = window.innerHeight || document.documentElement.clientHeight;
        svgSections.forEach((sec) => {
            if (sec.dataset.manualLock === "true") return;
            const rect = sec.getBoundingClientRect();
            const startY = winH * 0.85;
            const endY = winH * 0.15;
            const raw = (startY - rect.top) / (startY - endY);
            applySectionProgress(sec, raw);
        });
    }

    let ticking = false;
    window.addEventListener("scroll", function () {
        if (!ticking) {
            window.requestAnimationFrame(function () {
                updateSectionsOnScroll();
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

    updateSectionsOnScroll();
});
</script>
