$(document).ready(function () {
    // save if the table is locked or not
    var lockTable = true;

    /**
     * Click functionality of the lockTable button
     * - If table is locked : unlock table
     * - If table is unlocked : unlock table
     */
    $('#lockTable').click(function () {

        var col = $(this).parent().children().index($(this)) + 1;

        if (lockTable) {
            // Change icon of button
            $(this).attr('src', "/images/open-padlock-silhouette_32x32.png");

            // Lock every case of the table
            $('tr td:nth-child(' + col + ')').each(function () {
                $('.clickableCase').removeClass('locked');
            });

            lockTable = false;
        } else {
            // Change icon of button
            $(this).attr('src', "/images/padlock_32x32.png");

            // Unlock every case of the table
            $('tr td:nth-child(' + col + ')').each(function () {
                $('.clickableCase').addClass('locked');
            });

            lockTable = true;
        }
    });

    /**
     * Click functionality of the clickable cases
     */
    $('.clickableCase').click(function () {
        // Test if table is locked
        if (!$(this).hasClass('locked')) {
            // Test if the current user is not a teacher
            if (!$(this).hasClass('teacher')) {
                var items = [];
                var col = $(this).parent().children().index($(this)) + 1;
                // Test if student has access to edit the col
                if ($('.access').index() + 1 == col) {
                    $('tr td:nth-child(' + col + ')').each(function () {
                        //add item to array
                        items.push($(this).text().replace(/\s/g, ''));
                    });

                    if ($(this).text().replace(/\s/g, '') != "") {
                        recalculateRank(col, $(this).text().replace(/\s/g, ''));
                        $(this).text("");
                    } else {
                        // Else if for limit 3 choices
                        if (jQuery.inArray("1", items) == -1) {
                            $(this).text(1)
                        } else if (jQuery.inArray("2", items) == -1) {
                            $(this).text(2)
                        } else if (jQuery.inArray("3", items) == -1) {
                            $(this).text(3)
                        } else {
                            // View The toast message
                            $('.alert-info').text("Vous ne pouvez que 3 souhaits.");
                            $('.alert-info').removeClass('hidden');
                            cleanMessage();
                        }
                    }
                } else {
                    // View The toast message
                    $('.alert-info').text("Vous n'avez pas le droit de modifier les souhaits d'un autre élève.");
                    $('.alert-info').removeClass('hidden');
                    cleanMessage();
                }
            } else {
                // Teacher function
                // Test if had already a postulation
                if ($(this).hasClass('postulationRequest')) {
                    $(this).removeClass('postulationRequest');
                    $(this).addClass('postulationDone');
                } else if ($(this).hasClass('postulationDone')) {
                    $(this).removeClass('postulationDone');
                } else {
                    $(this).addClass('postulationRequest');
                }
            }
        } else {
            // View The toast message
            $('.alert-info').text("Le tableau est bloqué en édition.");
            $('.alert-info').removeClass('hidden');
            cleanMessage();
        }
    });

    $('#choicesForm').submit(function() {
        return prepareStudentData();
    });

    /**
     * Recalculate the rank in a column, when a wish has been removed
     * @param col column whose ranks must be recalculated
     * @param nbRemove rank removed
     */
    function recalculateRank(col, nbRemove) {
        // Do that for each row in col
        $('tr td:nth-child(' + col + ')').each(function () {
            //add item to array
            if ($(this).text().replace(/\s/g, '') != "") {
                switch (nbRemove) {
                    case "1":
                        // Change 2 to 1 and 3 to 2
                        if ($(this).text().replace(/\s/g, '') == "2") {
                            $(this).text("1");
                        }
                        if ($(this).text().replace(/\s/g, '') == "3") {
                            $(this).text("2");
                        }
                        break;
                    case "2":
                        // Change 3 to 2
                        if ($(this).text().replace(/\s/g, '') == "3") {
                            $(this).text("2");
                        }
                        break;
                    default:
                    // Do nothing
                }
            }
        });
    }

    class Wishes {
        constructor() {
            this.wishes = [];
        }

        addWish(wish) {
            this.wishes.push(wish);
        }
    }

    class Wish {
        constructor(company_id, rank) {
            this.company_id = company_id;
            this.rank = rank;
        }
    }

    /**
     * Get the list of wishes of the current student user
     *
     * @returns {Wishes} container of the wishes
     */
    function getWishes() {
        let wishesContainer = new Wishes();

        $('.currentStudent').each(function () {

            let rank = $(this).text().trim();
            console.log($(this));
            console.log(rank);

            // we are not interested in not selected internships
            if (rank === "") {
                return
            }

            // TODO fix, for is undefined
            let row = $(this).rowIndex;
            console.log(row);

            // TODO get real id of the company
            let company_id = row;

            let wish = new Wish(company_id, rank);
            wishesContainer.addWish(wish);
        });

        return wishesContainer;
    }

    /**
     * Prepare the content of the form to be sent by the student when saving their wishes
     */
    function prepareStudentData() {
        let wishes = getWishes();

        $('#choices').innerText = wishes;

        console.log(wishes);

        return false;
    }

    /**
     * Remove the alert-info
     */
    function cleanMessage() {
        $(".alert-info").fadeTo(2000, 500).slideUp(500, function () {
            $(".alert-info").slideUp(500);
        });
    }
});