import { Container, Card } from 'react-bootstrap';
import ColorForm from './partials/ColorForm';

function Create() {

    return (
        <Container className='mt-5'>
            <Card bg='dark' text="light" border='light'>
                <Card.Header className='d-flex justify-content-between'>
                    <Card.Title>Create Color</Card.Title>
                </Card.Header>
                <Card.Body>
                    <ColorForm />
                </Card.Body>
            </Card>
        </Container>
    );
}

export default Create;
