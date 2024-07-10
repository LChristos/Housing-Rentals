<footer>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        footer {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            padding: 15px;
            text-align: center;
        }
        .contact-info, .map {
            padding: 13px;
        }
        .map iframe {
            width: 100%;
            height: 100%;
        }
        @media (max-width: 1000px) {
            footer {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <div class="contact-info" style="text-align: center;">
        <p>Contact us at: <a href="tel:+123456789">+123456789</a> | <a href="mailto:info@dsestate.com">info@dsestate.com</a></p>
    </div>
    <div class="map" style="text-align: center;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12585.625809152712!2d23.6615982192021!3d37.944294544773946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a1bbe5bb8515a1%3A0x3e0dce8e58812705!2zzqDOsc69zrXPgM65z4PPhM6uzrzOuc6_IM6gzrXOuc-BzrHOuc-Oz4I!5e0!3m2!1sel!2sgr!4v1718867231415!5m2!1sel!2sgr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</footer>