import { Button, Modal } from "react-bootstrap";

function PopUp(props: PopUpProps) {

    return (
        <Modal key={props.id} backdrop="static" keyboard={false} show={props.show} onHide={props.handleShow}>
            <Modal.Header closeButton>
                <Modal.Title>{props.title}</Modal.Title>
            </Modal.Header>
            <Modal.Body>{props.message}</Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={props.handleShow}>Close</Button>
                <Button variant="primary" onClick={props.submitFunction}>{props.subButtonTitle}</Button>
            </Modal.Footer>
        </Modal>
    );
}

interface PopUpProps {
    id: string,
    show: boolean,
    title: string,
    message: string,
    handleShow(): void,
    subButtonTitle: string,
    submitFunction: any
};

export default PopUp;