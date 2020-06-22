var app = new Vue({
    el: "#app2",
    data: {
        inputs: [
            {
                name: ""
            }
        ],
        monto: [],
        total: 0
    },
    methods: {
        add(index) {
            this.inputs.push({ name: "" });
        },
        remove(index) {
            console.log(this.inputs.splice(index, 1));
            this.inputs.splice(index, 1);
        }
    }
});
