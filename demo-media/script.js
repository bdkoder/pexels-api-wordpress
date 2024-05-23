(function ($) {
    $(document).ready(function () {
        // Extend the media library to add a new tab
        var originalMediaFrame = wp.media.view.MediaFrame.Select;

        wp.media.view.MediaFrame.Select = originalMediaFrame.extend({
            initialize: function () {
                originalMediaFrame.prototype.initialize.apply(this, arguments);
                this.createMyCustomTab();
            },
            createMyCustomTab: function () {
                this.on('content:render:browse', this.addMyCustomTab, this);
            },
            addMyCustomTab: function (browser) {
                var self = this;
                browser.toolbar.set('my_custom_tab', {
                    text: 'My Custom Tab',
                    priority: 100,
                    click: function () {
                        self.content.mode('my_custom_tab');
                    }
                });

                browser.content.mode('my_custom_tab', new wp.media.view.MyCustomTabContent({
                    controller: this
                }));
            }
        });

        wp.media.view.MyCustomTabContent = wp.media.View.extend({
            className: 'my-custom-tab-content',
            initialize: function () {
                this.render();
            },
            render: function () {
                this.$el.html('<h2>My Custom Tab Content</h2><p>This is where you can add custom content for your new tab.</p>');
                return this;
            }
        });
    });
})(jQuery);
