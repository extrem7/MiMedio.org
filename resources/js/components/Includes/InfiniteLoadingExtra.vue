<script>
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        name: 'InfiniteLoadingExtra',
        extends: InfiniteLoading,
        methods: {
            getCurrentDistance() {
                switch (this.direction) {
                    case 'top':
                        return isNaN(this.scrollParent.scrollTop)
                            ? this.scrollParent.pageYOffset
                            : this.scrollParent.scrollTop;
                    case 'left':
                        return isNaN(this.scrollParent.scrollLeft)
                            ? this.scrollParent.pageXOffset
                            : this.scrollParent.scrollLeft;
                    case 'bottom':
                        return (
                            this.$el.getBoundingClientRect().top -
                            (this.scrollParent === window
                                ? window.innerHeight
                                : this.scrollParent.getBoundingClientRect().bottom)
                        );
                    case 'right':
                        return (
                            this.$el.getBoundingClientRect().left -
                            (this.scrollParent === window
                                ? window.innerWidth
                                : this.scrollParent.getBoundingClientRect().right)
                        );
                    default:
                        return 0;
                }
            },
            getScrollParent(elm = this.$el) {
                if (elm.tagName === 'BODY') {
                    return window;
                }

                if (
                    !this.forceUseInfiniteWrapper &&
                    (((this.direction === 'top' || this.direction === 'bottom') &&
                        ['scroll', 'auto'].indexOf(getComputedStyle(elm).overflowY) > -1) ||
                        ((this.direction === 'left' || this.direction === 'right') &&
                            ['scroll', 'auto'].indexOf(getComputedStyle(elm).overflowX) > -1))
                ) {
                    return elm;
                }

                if (
                    elm.hasAttribute('infinite-wrapper') ||
                    elm.hasAttribute('data-infinite-wrapper')
                ) {
                    return elm;
                }

                return this.getScrollParent(elm.parentNode);
            }
        }
    };
</script>
