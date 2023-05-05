Alpine.data("dropdown", () => ({
    showMessage: false,
    copyToClipboard() {
        navigator.clipboard.writeText(
            // This requires torchlight.options.copyable to be "true" on the PHP side.
            $this.root.querySelector(".torchlight-copy-target").textContent
        );
        // show the "copied" message for 2 seconds
        this.showMessage = true;
        setTimeout(() => (this.showMessage = false), 2000);
    },
}));
