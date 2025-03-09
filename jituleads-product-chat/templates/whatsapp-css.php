<style>
/* Style for WhatsApp button functionality for JituLeads Product Chat plugin.
 * Description: Auto-update for dynamic chat buttons for WooCommerce product.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */

            /* WhatsApp Color */
            .marketingjituleads {
                padding-bottom: 35px;
                padding-top: 35px;
            }
            .marketing_wa {
                display: flex;
            }
            .marketing_wa img {
                height: 70px;
                object-fit: cover;
                width: 70px;
                border-radius: 100%;
                margin-bottom: -6px;
            }
            .marketingjituleads_content {
                display: flex;
                flex-direction: column;
            }
            .marketingjituleads {
                max-width: 350px;
                gap: 15px;
                display: flex;
                flex-direction: column;
            }
            .marketingjituleads * {
                text-decoration: none;
            }
            .marketing_wa {
                padding: 8px;
                gap: 15px;
                background: linear-gradient(135deg, #25D366, #128C7E); /* WhatsApp-like gradient */
                color: #fff;
                overflow: hidden;
                height: 70px;
                border-radius: 60px;
                display: flex;
                align-items: center; /* Centers the content vertically */
                justify-content: left; /* Centers the content horizontally */
                position: relative;
                box-shadow: 0 0 10px rgba(0,0,0,0.2); /* Optional: Add a subtle shadow */
            }

            /* Create the flash effect */
            .marketing_wa:before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%; /* Start off-screen to the left */
                width: 150%; /* Make the flash bigger than the container */
                height: 100%;
                background: rgba(255, 235, 59, 0.8); /* Flash color with transparency */
                transform: skewX(-30deg); /* Skew the background to create a diagonal flash effect */
                z-index: 1; /* Place the flash effect above the background but below the content */
                transition: all 0.6s ease-in-out; /* Smooth transition */
                opacity: 0; /* Start with no visibility */
            }

            /* On hover, trigger the light flash from left to right */
            .marketing_wa:hover:before {
                left: 100%; /* Move the flash across the element */
                opacity: 1; /* Make it visible */
            }

            /* Flash animation */
            @keyframes flash {
                0% {
                    left: -100%; /* Start the flash from left */
                    opacity: 0; /* Start invisible */
                }
                50% {
                    left: 50%; /* Move the flash halfway through */
                    opacity: 1; /* Make it visible */
                }
                100% {
                    left: 100%; /* End the flash to the right */
                    opacity: 0; /* Fade out as it moves */
                }
            }

            /* Ensure content stays visible and unaffected */
            .marketingjituleads_img, .marketingjituleads_content {
                position: relative; /* Keeps them above the pseudo-element */
                z-index: 2; /* Ensure content is above the flash effect */
            }

            a.marketing_link.walink {
                border-radius: 60px;
                background: transparent !important;
                position: relative;
            }

            span.marketingjituleads_status {
                background: #d9ff27f0;
                border-radius: 7px;
                max-width: fit-content;
                padding-left: 8px;
                padding-right: 8px;
                padding-top: 3px;
                padding-bottom: 3px;
                line-height: 1;
                order: 3;
                color: #111;
                text-decoration: none !important;
                font-weight: 600;
                font-size: 12px;
            }

            span.marketingjituleads_text {
                font-size: 14px;
            }

            span.marketingjituleads_desc {
                font-weight: 600;
            }

            .marketingjituleads {
                background-color: transparent !important;
            }
            /* End WhatsApp Color */
        </style>