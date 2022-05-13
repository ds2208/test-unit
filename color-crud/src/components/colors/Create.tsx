import { Container, Card, Form, Button } from 'react-bootstrap';

function Create() {

    return (
        <Container className='mt-5'>
            <Card bg='dark' text="light" border='light'>
                <Card.Header className='d-flex justify-content-between'>
                    <Card.Title>Create Color</Card.Title>
                </Card.Header>
                <Card.Body>
                    <Form action=''>
                        <Form.Group className="mb-3" controlId="formBasicName">
                            <Form.Label>Color Name</Form.Label>
                            <Form.Control type="text" placeholder="Enter Color Name" />
                            <Form.Text className="text-muted">Required.</Form.Text>
                        </Form.Group>
                        <Form.Group className="mb-3" controlId="formBasicHexValue">
                            <Form.Label>Hex Value</Form.Label>
                            <Form.Control type="number" placeholder="Hex value" />
                            <Form.Text className="text-muted">Required.</Form.Text>
                        </Form.Group>
                        <Form.Group className="mb-3" controlId="formBasicStatus">
                            <Form.Check type="checkbox" label="Color status" />
                            <Form.Text className="text-muted">Required.</Form.Text>
                        </Form.Group>
                        <Button variant="outline-light" type="submit">Submit</Button>
                    </Form>
                </Card.Body>
            </Card>
        </Container>
    );
}

export default Create;
