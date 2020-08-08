class BirdboardForm {
    constructor(data) {
        this.originalData = {};

        // This is SHALLOW MERGE
        // Object.assign(this.originalData, data);

        this.originalData = JSON.parse(JSON.stringify(data));
        // This is DEEP MERGE

        Object.assign(this, data);

        this.errors = {};
        this.submitted = false;
    }

    data() {
        // let data = {};
        //
        // for (let attribute in this.originalData) {
        //     data[attribute] = this[attribute];
        // }
        //
        // return data;
        // doorh baidaar hyalbarchilj bolno

        return Object.keys(this.originalData).reduce((data, attribute) => {
            data[attribute] = this[attribute];

            return data;
        }, {});
    }

    post(endpoint) {
        this.submit(endpoint);
    }

    patch(endpoint) {
        this.submit(endpoint, 'patch');
    }

    delete(endpoint) {
        this.submit(endpoint, 'delete');
    }

    submit(endpoint, requestType = 'post') {
        return axios[requestType](endpoint, this.data())
            .catch(this.onFail.bind(this))
            .then(this.onSuccess.bind(this));
    }

    onSuccess(response) {
        this.submitted = true;
        this.errors = {};

        return response;
    }

    onFail(error) {
        this.errors = error.response.data.errors;
        this.submitted = false;

        throw error; // axios iin then method tsaash yawahgui zogsoono.
    }

    reset() {
        Object.assign(this, this.originalData);
    }
}

export default BirdboardForm;
