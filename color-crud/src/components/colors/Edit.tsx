import { Container, Card } from 'react-bootstrap';
import { useParams } from 'react-router-dom';
import ColorForm from './partials/ColorForm';

function Edit() {

    let { id } = useParams();

    return (
        <Container className='mt-5'>
            <Card bg='dark' text="light" border='light'>
                <Card.Header className='d-flex justify-content-between'>
                    <Card.Title>Edit Color</Card.Title>
                </Card.Header>
                <Card.Body>
                    <ColorForm colorId={id} />
                </Card.Body>
            </Card>
        </Container>
    );
}

export default Edit;
