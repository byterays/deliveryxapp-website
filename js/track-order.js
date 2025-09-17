class TrackingManager {
    constructor(options = {}) {
        this.templateUrl = options.templateUrl || "ui-blocks/tracking-result.html";
        this.apiUrl = options.apiUrl || "api/track-order.php";
        this.resultSelector = options.resultSelector || "#section-tracking-result";
        this.formSelector = options.formSelector || "#trackForm";
        this.inputSelector = options.inputSelector || "#tidInput";
        this.trackingTemplate = "";
        this.initialTrackingId = options.initialTrackingId || "";
        this.statusConfig = {
            order_received: {
                icon: "fa-file-text",
                message: "Order has been received"
            },
            picked_up: {
                icon: "fa-truck",
                message: "Shipment has been picked up"
            },
            in_transit: {
                icon: "fa-road",
                message: "Shipment is in transit"
            },
            out_for_delivery: {
                icon: "fa-motorcycle",
                message: "Shipment is out for delivery"
            },
            delivered: {
                icon: "fa-check-circle",
                message: "Shipment has been delivered"
            },
            return_to_origin: {
                icon: "fa-undo",
                message: "Shipment is returning to origin"
            }
        };

        this.init();
    }

    init() {
        // Load template
        this.loadTemplate();

        // Bind form submit
        this.bindForm();

        // Auto-fetch if initial tracking ID exists
        if (this.initialTrackingId.trim()) {
            this.fetchTracking(this.initialTrackingId);
        } else {
            // Show template as default after template is loaded
            $(document).ajaxStop(() => {
                if (!this.initialTrackingId) {
                    $(this.resultSelector).html(this.trackingTemplate);
                }
            });
        }
    }

    loadTemplate() {
        $.get(this.templateUrl, (html) => {
            this.trackingTemplate = html;
            console.log("Template loaded");
        }).fail(() => {
            console.log("Failed to load template");
        });
    }

    populateTemplate(data) {
        var self = this;
        if (!this.trackingTemplate) return "";
        // Replace all {{key}} placeholders with corresponding data

        let html = this.trackingTemplate;

        // Handle array: history
        if (Array.isArray(data.history)) {
            const historyHtml = data.history.map(item => {

                const statusKey = (item.history_status || "").toLowerCase().replace(/\s+/g, "_");
                const config = this.statusConfig[statusKey] || {
                    icon: "fa-info-circle",
                    message: `Status: ${item.history_status || ""}`
                };

                return `<li class="timeline-inverted">
                            <div data-wow-delay=".2s" class="timeline-date wow zoomIn" style="visibility: visible; animation-delay: 0.2s; animation-name: zoomIn;">
                                ${item.history_date || ""}
                            </div>
                            <div class="timeline-badge info">
                                <i class="fa ${config.icon} wow zoomIn" style="visibility: visible; animation-name: zoomIn;"></i>
                            </div>
                            <div data-wow-delay=".6s" class="timeline-panel wow fadeInRight" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInRight;">
                                <div class="timeline-body">
                                    ${config.message} <span class="location">${self._capitalize(item.history_location.toLowerCase()) || ""}</span>
                                </div>
                            </div>
                        </li>`;
            }).join("");
            html = html.replace("{{history}}", historyHtml);
        } else {
            html = html.replace("{{history}}", "");
        }

        // Replace all {{key}} placeholders for other fields
        html = html.replace(/{{\s*([\w\.]+)\s*}}/g, (match, key) => {
            const value = key.split('.').reduce((obj, k) => (obj && obj[k] !== undefined ? obj[k] : ""), data);
            return value !== null ? value : "";
        });

        return html;
    }

    updateProgressBar(status) {
        const $progressItems = $(this.resultSelector).find("ul.progress li");

        // Normalize status (lowercase + underscore)
        const statusKey = (status || "").toLowerCase().replace(/\s+/g, "_");

        const index = Object.keys(this.statusConfig).indexOf(statusKey);

        $progressItems.removeClass("active");

        if (index >= 0) {
            $progressItems.each(function (i) {
                if (i == index) {
                    $(this).addClass("active");
                }
            });
        }
    }


    fetchTracking(trackingId) {
        const $result = $(this.resultSelector);

        if (!trackingId) {
            $result.html(this.trackingTemplate);
            $result.slideDown();
            return;
        }

        $.ajax({
            url: this.apiUrl,
            type: "POST",
            data: { tid: trackingId },
            success: (response) => {
                console.log(response);

                if (response.success && response.data) {
                    const populatedHtml = this.populateTemplate(response.data);
                    $result.html(populatedHtml);
                    this.updateProgressBar(response.data.shipment.status);

                    $result.slideDown();
                    $('html, body').animate({
                        scrollTop: $("#section-tracking").offset().top
                    }, 500);
                } else {
                    $result.html("<p>No tracking data found.</p>");
                }
            },
            error: (xhr, status, error) => {
                console.log("Error fetching tracking results:", error);
            }
        });
    }

    bindForm() {
        $(this.formSelector).on("submit", (e) => {
            e.preventDefault();
            const trackingId = $.trim($(this.inputSelector).val());

            // Update URL without reload
            const newUrl = `${window.location.protocol}//${window.location.host}${window.location.pathname}?tid=${encodeURIComponent(trackingId)}`;
            history.pushState({ path: newUrl }, "", newUrl);

            this.fetchTracking(trackingId);
        });
    }

    _capitalize (text) {
        if (!text) return "";
        return text.charAt(0).toUpperCase() + text.slice(1);
    }
}
