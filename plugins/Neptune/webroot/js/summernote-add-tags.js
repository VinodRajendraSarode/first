/**

 *
 */

(function (factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(window.jQuery);
    }
}(function ($) {

    // Extends plugins for emoji plugin.
    $.extend($.summernote.plugins, {

        'add-text-tags': function (context) {
            var self = this;
            var ui = $.summernote.ui;
            var options = context.options;

            self.generateBtn = function(tag, tooltip) {
                var char = tag.slice(0,1).toUpperCase();
                return ui.button({
                    contents: '<p>['+tag+']</p>',
                    tooltip: tooltip + ' [' + tag + ']',
                    className: 'note-add-text-tags-btn',
                    click: function (e) {
                        self.wrapInTag(tag);
                    }
                });
            };


            var name = self.generateBtn('name', 'Employee Name');
            var email = self.generateBtn('email', 'Email');
            var mobile = self.generateBtn('mobile', 'Mobile');
            var address = self.generateBtn('address', 'Address');

            var region = self.generateBtn('region', 'Region');
            var branch = self.generateBtn('branch', 'Branch');
            var designation = self.generateBtn('designation', 'Designation');
            var department = self.generateBtn('department', 'Department');
            var location = self.generateBtn('location', 'Location');

            var dob = self.generateBtn('dob', 'Date of Birth');
            var joining_date = self.generateBtn('joining_date', 'Joining Date');
            var probation_date = self.generateBtn('probation_date', 'Probation Date');
            var confirmation_date = self.generateBtn('confirmation_date', 'Confirmation Date');
            var resignation_date = self.generateBtn('resignation_date', 'Resignation Date');
            var relieving_date = self.generateBtn('relieving_date', 'Relieving Date');

            context.memo('button.add-text-tags', function () {
                return ui.buttonGroup([
                    ui.button({
                        className: 'dropdown-toggle',
                        contents: '<b>+</b> ' + ui.icon(options.icons.caret, 'span'),
                        tooltip: 'Additional text styles',
                        data: {
                            toggle: 'dropdown'
                        }
                    }),
                    ui.dropdown([
                        ui.buttonGroup({
                            className: 'note-add-text-tags-code',
                            children: [
                                name, email, mobile, address, region, 
                                branch, designation, department, location,
                                dob, joining_date, probation_date, confirmation_date, resignation_date, relieving_date
                            ]
                        }),
                    ])
                ]).render();
            });

            self.areDifferentBlockElements = function(startEl, endEl) {
                var startElDisplay = getComputedStyle(startEl, null).display;
                var endElDisplay  = getComputedStyle(endEl, null).display;

                if(startElDisplay !== 'inline' && endElDisplay !== 'inline') {
                    console.log("Can't insert across two block elements.")
                    return true;
                }
                else {
                    return false;
                }
            };

            self.isSelectionParsable = function(startEl, endEl) {

                if(startEl.isSameNode(endEl)) {
                    return true;
                }
                if( self.areDifferentBlockElements(startEl, endEl)) {
                    return false;
                }
                // if they're not different block elements, then we need to check if they share a common block ancestor
                // could do this recursively, if we want to back farther up the node chain...
                var startElParent = startEl.parentElement;
                var endElParent = endEl.parentElement;
                if( startEl.isSameNode(endElParent)
                    || endEl.isSameNode(startElParent)
                    || startElParent.isSameNode(endElParent) )
                {
                    return true;
                }
                else
                    console.log("Unable to parse across so many nodes. Sorry!")
                    return false;
            };

            self.wrapInTag = function (tag) {
                // from: https://github.com/summernote/summernote/pull/1919#issuecomment-304545919
                // https://github.com/summernote/summernote/pull/1919#issuecomment-304707418
                var selection = document.getSelection();
                var cursorPos = selection.anchorOffset;
                var oldContent = selection.anchorNode.nodeValue;
                if(oldContent!=null) {
                    var newContent = oldContent.substring(0, cursorPos) + '[' + tag + ']' + oldContent.substring(cursorPos);
                } else {                    
                    var newContent = '[' + tag + ']';
                }
                selection.anchorNode.nodeValue = newContent;
            };
        }
    });
}));
