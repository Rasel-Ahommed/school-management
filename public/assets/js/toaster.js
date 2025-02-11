document.addEventListener("DOMContentLoaded", function () {
    const toastContainer = document.createElement("div");
    toastContainer.id = "toast-container";
    document.body.appendChild(toastContainer);
});

function showToast(title, message, type = "info", duration = 3000) {
    const toastContainer = document.getElementById("toast-container");
    const toast = document.createElement("div");
    toast.className = `toast ${type}`;

    // Add icon using Iconify
    const icon = document.createElement("div");
    icon.className = "icon";
    icon.innerHTML = getIcon(type);

    // Add content (title and message)
    const content = document.createElement("div");
    content.className = "toaster-content";
    const toastTitle = document.createElement("div");
    toastTitle.className = "title";
    toastTitle.innerText = title;
    const toastMessage = document.createElement("div");
    toastMessage.className = "message";
    toastMessage.innerText = message;
    content.appendChild(toastTitle);
    content.appendChild(toastMessage);

    // Add close button
    const closeBtn = document.createElement("button");
    closeBtn.className = "close-btn";
    closeBtn.innerHTML = "&times;";
    closeBtn.onclick = () => toast.remove();

    // Add progress bar
    const progressBar = document.createElement("div");
    progressBar.className = "progress-bar";
    progressBar.style.animation = `progress ${duration}ms linear`;

    // Assemble toast
    toast.appendChild(icon);
    toast.appendChild(content);
    toast.appendChild(closeBtn);
    toast.appendChild(progressBar);
    toastContainer.appendChild(toast);

    // Show toast
    setTimeout(() => {
        toast.classList.add("show");
    }, 10);

    let timeoutId;
    let hoverStartTime;
    let reducedDuration = duration / 2; // Reduce time to half after hover

    const startTimer = (time) => {
        progressBar.style.animation = `progress ${time}ms linear`;
        timeoutId = setTimeout(() => {
            toast.classList.remove("show");
            setTimeout(() => toast.remove(), 300);
        }, time);
    };

    const clearTimer = () => {
        clearTimeout(timeoutId);
        progressBar.style.animation = "none"; // Pause animation
    };

    // Start the initial timer
    startTimer(duration);

    // Pause on hover
    toast.addEventListener("mouseenter", () => {
        clearTimer();
        hoverStartTime = Date.now(); // Capture the time hover starts
    });

    // Restart timer and progress bar from beginning on mouse leave
    toast.addEventListener("mouseleave", () => {
        const hoverDuration = Date.now() - hoverStartTime; // Calculate how long it was hovered
        reducedDuration = Math.max(1000, reducedDuration); // Ensure a minimum duration
        startTimer(reducedDuration); // Restart timer with reduced duration
    });
}

// Function to get the appropriate Iconify icon based on the type
function getIcon(type) {
    switch (type) {
        case "success":
            return '<iconify-icon icon="mdi:check-circle" style="color: #28a745; font-size: 24px;"></iconify-icon>';
        case "error":
            return '<iconify-icon icon="mdi:alert-circle" style="color: #dc3545; font-size: 24px;"></iconify-icon>';
        case "warning":
            return '<iconify-icon icon="mdi:alert" style="color: #ffc107; font-size: 24px;"></iconify-icon>';
        case "info":
            return '<iconify-icon icon="mdi:information" style="color: #17a2b8; font-size: 24px;"></iconify-icon>';
        default:
            return '<iconify-icon icon="mdi:information" style="color: #17a2b8; font-size: 24px;"></iconify-icon>';
    }
}
