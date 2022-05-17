import { useState } from "react";
import { Toast, ToastContainer } from "react-bootstrap";

function Toaster(message: string, title: string) {

    const [show, setShow] = useState(message !== "" ? true : false);

    return (
        <ToastContainer className="p-3" position="bottom-end">
            <Toast className="d-inline-block m-5" bg='dark' show={show} onClose={() => setShow(false)}>
                <Toast.Header>
                    <img src="holder.js/20x20?text=%20" className="rounded me-2" alt="" />
                    <strong className="me-auto">{title}</strong>
                </Toast.Header>
                <Toast.Body className={'dark' === 'dark' ? 'text-white' : ''}>
                    {message}
                </Toast.Body>
            </Toast>
        </ToastContainer>
    );
}

export default Toaster;