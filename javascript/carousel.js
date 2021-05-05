class Carousel {
    #ID = "";
    #images = [];
    #captions = [];
    #oldIndex = 0;
    #index = 0;
    #changing = false;
    #positionIndicator;
    #hasChanged = true;

    constructor(ID) {
        this.#ID = ID;
        this.#images = document.getElementById(this.#ID).querySelector(".imageContainer").children;
        this.#positionIndicator = document.getElementById(this.#ID).querySelector("#positionIndicator");

        for (let i = 0; i < this.#images.length; i++) {
            if (i != 0) {
                this.#images[i].style.display = "none";
                document.getElementById(this.#images[i].getAttribute("data-caption")).style.display = "none";
            }

            this.#captions.push(document.getElementById(this.#images[i].getAttribute("data-caption")));
        }

        this.updatePositionIndicator();
    }

    navigateRight() {
        if (this.#changing) return;
        this.#changing = true;
        this.#hasChanged = true;

        this.#oldIndex = this.#index;
        this.#index++;
        if (this.#index >= this.#images.length) this.#index = 0;

        this.hideOldIndex();
    }

    navigateLeft() {
        if (this.#changing) return;
        this.#changing = true;
        this.#hasChanged = true;

        this.#oldIndex = this.#index;
        this.#index--;
        if (this.#index <= 0) this.#index = this.#images.length - 1;

        this.hideOldIndex();
    }

    cycle() {
        if (this.#hasChanged) {
            this.#hasChanged = false;
            return;
        }
        this.navigateRight();
    }

    hideOldIndex() {
        $("#" + this.#captions[this.#oldIndex].id).fadeOut();
        $("#" + this.#images[this.#oldIndex].id).fadeOut();

        var _this = this;
        setTimeout(function() {
            _this.showNewIndex();
        }, 400);
    }

    showNewIndex() {
        $("#" + this.#captions[this.#index].id).fadeIn();
        $("#" + this.#images[this.#index].id).fadeIn();
        this.updatePositionIndicator();

        this.#changing = false;
    }

    updatePositionIndicator() {
        let indicator = "";
        for (let i = 0; i < this.#images.length; i++) {
            if (i != 0) indicator += " ";
            if (this.#index == i) indicator += "<span id='selected'>__</span>";
            else indicator += "__";
        }

        this.#positionIndicator.innerHTML = indicator;
    }
}