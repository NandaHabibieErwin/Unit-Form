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

export const ManageReport = async (id, status) => {
    try {
        const response = await axios.post(`/report/manage/${id}/${status}`);
        console.log(response.data);
        return response.data;

    } catch (error) {
        console.error('Error: ', error);
        throw error;
    }
};

export const FetchContact = async () => {
    try {
        const response = await axios.get('/contact/get');
        return response.data;
    } catch (error) {
        console.error('Error fetching contacts:', error);
        throw error;
    }
};

export async function UploadContact(formData) {
    try {
        console.log('Contact:',formData);
        const response = await axios.post('/contact/store', formData);
        return response.data;
    } catch (error) {

        console.error('Error uploading form:', error.response || error);
        throw new Error('Failed to upload form');
    }
}


export const UpdateContact = async (id, contactData) => {
    try {
        const response = await axios.post(`/contact/update/${id}`, contactData);
        console.log(response.data);
        return response.data;
    } catch (error) {
        console.error('Error: ', error);
        throw error;
    }
};

export const DeleteContact = async (id) => {
    try {
        const response = await axios.delete(`/contact/delete/${id}`);
        console.log(response.data);
        return response.data;
    } catch (error) {
        console.error('Error: ', error);
        throw error;
    }
};

export const SearchReports = async ({ name, no_unit, tanggal_data, kelayakan, page }) => {
    try {
        const response = await axios.get('/report/search', {
            params: {
                name: name || undefined,
                no_unit: no_unit || undefined,
                tanggal_data: tanggal_data || undefined,
                kelayakan: kelayakan || undefined,
                page: page || 1,
            },
        });
        return response.data;
    } catch (error) {
        console.error('Error fetching reports:', error);
        return { data: [], total_pages: 1, current_page: 1 };
    }
};

