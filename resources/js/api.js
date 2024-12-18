import axios from "axios";


axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

export async function UploadForm(formData) {
    try {
        const response = await axios.post('/form/post', formData);


        return response.data;
    } catch (error) {

        console.error('Error uploading form:', error.response || error);
        throw new Error('Failed to upload form');
    }
}

export const ApproveReport = async () => {
    try {
        const response = await axios.get('/report');
        console.log(response.data);
        const { props } = response.data;
            return {
                Data: props.data,
            }

    } catch (error) {
        console.error('Cannot load excel file', error);
        throw error;
    }
};

