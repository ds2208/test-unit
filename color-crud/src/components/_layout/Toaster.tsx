import { Toast, ToastContainer } from "react-bootstrap";

function Toaster(props: PopUpProps) {

    return (
        <ToastContainer className="p-3" position="top-end" style={{zIndex: 999}}>
            <Toast 
                key={props.id} 
                show={props.show} 
                delay={3000} 
                autohide
                bg={props.type ?? "light"} 
                className="d-inline-block m-5" 
                onClose={props.handleShow}
                >
                <Toast.Header>
                    <img src="holder.js/20x20?text=%20" className="rounded me-2" alt="" />
                    <strong className="me-auto">{props.title}</strong>
                </Toast.Header>
                <Toast.Body className={ props.type === 'dark' ? 'text-white' : ''}>
                    {props.message}
                </Toast.Body>
            </Toast>
        </ToastContainer>
    );
}

interface PopUpProps {
    id: string,
    show: boolean,
    title: string,
    message: string,
    handleShow: any,
    type?: string
};

export default Toaster;