import { useEffect, useState } from 'react';
import { Container, Card, Table } from 'react-bootstrap';
import { IoAddCircleSharp } from 'react-icons/io5';
import { deleteColor, getColors } from '../../services/colors-service';
import Color from './partials/Color';

function List() {

  const [colors, setColors] = useState<any[]>([]);

  useEffect(() => {
    getColors().then(result => {
      setColors(result.data.data.colors);
    })
  }, []);

  const removeColor = (colorId: number): any => {
    const response = deleteColor(colorId);
    response.catch(errors => {
      console.log(errors);
    }).then(result => {
      if (result) {
        const newColors = colors.filter((color) => color.id !== colorId);
        setColors(newColors);
      }
    });
  }

  return (
    <Container className='mt-5'>
      <Card bg='dark' text="light" border='light'>
        <Card.Header className='d-flex justify-content-between'>
          <Card.Title>List of Colors</Card.Title>
          <a className='btn btn-outline-light' href='/colors/new'> Create <IoAddCircleSharp></IoAddCircleSharp></a>
        </Card.Header>
        <Card.Body>
          <Table striped hover variant="dark" className='text-center'>
            <thead>
              <tr>
                <th>#</th>
                <th>Color Name</th>
                <th>Hex Value</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {
                colors.map(color => {
                  return (
                    <Color key={color.id} color={color} removeColor={removeColor}></Color>
                  )
                })
              }
            </tbody>
          </Table>
        </Card.Body>
      </Card>
    </Container>
  );
}

export default List;
