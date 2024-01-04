<template>
    <div class="product-details-quantity">
        <div class="input-group input-spinner">
            <div class="input-group-prepend">
                <button
                    style="min-width: 26px"
                    class="btn btn-decrement btn-spinner"
                    @click="decrement"
                    type="button"
                >
                    <i class="icon-minus"></i>
                </button>
            </div>
            <input
                type="text"
                class="form-control text-center"
                required
                placeholder
                v-model="current"
                @change="setCurrent($event)"
            />
            <div class="input-group-append">
                <button
                    style="min-width: 26px"
                    class="btn btn-increment btn-spinner"
                    @click="increment"
                    type="button"
                >
                    <i class="icon-plus"></i>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        product: {
            type: Object
        }
    },
    data: function() {
        return {
            current: this.product.quantity ? this.product.quantity : 1
        };
    },
    watch: {
        product: function() {
            this.current = this.product.quantity ? this.product.quantity : 1;
        }
    },
    methods: {
        increment: function() {
            if (this.product.quantity && this.current >= this.product.qty)
                return;
            this.current++;
            this.$emit("change-qty", this.current, this.product);
            console.log("change-qty", this.current);
        },

        decrement: function() {
            if (this.current > 1) {
                this.current--;
                this.$emit("change-qty", this.current, this.product);
            }
        },
        setCurrent: function(event) {
            this.current = parseInt(event.currentTarget.value);
            this.$emit("change-qty", this.current, this.product);
        }
    }
};
</script>
