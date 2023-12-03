<style>
    /* Default styles for larger screens */
    .message {
        display: none; /* Hide the message by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        text-align: center;
        padding: 20px;
        font-size: 18px;
        z-index: 9999;
    }

    /* Media query for screens smaller than 600 pixels */
    @media screen and (max-width: 600px) {
        .message {
            display: block; /* Show the message for small screens */
            background-color: #f2f2f2;
            color: #333;
            padding: 10px;
            text-align: center;
            padding-top:10rem;
        }
    }
</style>

<div class="message">
Please use a larger screen device for a better experience.
</div>