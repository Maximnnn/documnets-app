<template>
    <div class="container">


            <div class="row">
                <form enctype="multipart/form-data">
                    <div class="custom-file">
                        <input type="file" name="document" class="custom-file-input" id="document">
                        <label class="custom-file-label" for="document">Choose file</label>
                    </div>

                    <button type="submit" v-on:click="upload" class="btn btn-primary">Upload</button>

                </form>
            </div>

            <div class="row">
                <div class="card col-md-3" v-for="document in documents">
                    <div class="card-body">
                        <a v-bind:href="document.path">{{document.name}}</a>
                    </div>
                </div>
            </div>

    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                documents: []
            };
        },
        mounted() {
            this.getList();
            $(".custom-file-input").on("change", this.uploadChange);
        },
        methods: {
            getList: function() {
                axios.get('api/file/getList')
                .then((response) => {
                    this.documents = response.data.data;
                })
            },
            uploadChange: function(e) {
                var fileName = $(e.target).val().split("\\").pop();
                $(e.target).siblings(".custom-file-label").addClass("selected").html(fileName);
            },
            upload: function(e) {
                e.preventDefault();

                let formData = new FormData();
                let document = $('#document')[0];
                formData.append("document", document.files[0]);
                axios.post('api/file/store', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
                    this.documents.push(response.data);
                })
            }
        }
    }
</script>
